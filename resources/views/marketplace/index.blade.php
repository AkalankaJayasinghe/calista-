@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Marketplace']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar Filters -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <form action="{{ route('marketplace.index') }}" method="GET" id="filterForm">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Filters</h3>
                            @if(request()->hasAny(['category', 'min_price', 'max_price', 'rating', 'search']))
                                <a href="{{ route('marketplace.index') }}" class="text-sm text-red-500 hover:underline">Clear All</a>
                            @endif
                        </div>

                        <!-- Search -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Search</h4>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search products..."
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Categories</h4>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="category" value="{{ $category->id }}" class="mr-2"
                                        {{ request('category') == $category->id ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $category->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Price Range</h4>
                            <div class="flex gap-2 mb-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                    placeholder="Min"
                                    class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                    placeholder="Max"
                                    class="w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Rs. 0</span>
                                <span>Rs. 500,000</span>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Rating</h4>
                            <div class="space-y-2">
                                @for($i = 5; $i >= 1; $i--)
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="mr-2"
                                        {{ request('rating') == $i ? 'checked' : '' }}>
                                    <div class="flex text-yellow-500 text-sm">
                                        @for($j = 1; $j <= $i; $j++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @for($j = $i + 1; $j <= 5; $j++)
                                        <i class="far fa-star text-gray-300"></i>
                                        @endfor
                                    </div>
                                    <span class="text-sm ml-1">& up</span>
                                </label>
                                @endfor
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 rounded-lg transition font-semibold">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                <div class="bg-white rounded-lg shadow p-4 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-xl font-bold">All Products</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 text-sm">
                                Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                            </span>
                            <select name="sort_by" id="sortSelect" onchange="updateSort(this.value)"
                                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                                <option value="created_at-desc" {{ request('sort_by') == 'created_at' && request('sort_order') == 'desc' ? 'selected' : '' }}>Newest First</option>
                                <option value="price-asc" {{ request('sort_by') == 'price' && request('sort_order') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price-desc" {{ request('sort_by') == 'price' && request('sort_order') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name-asc" {{ request('sort_by') == 'name' && request('sort_order') == 'asc' ? 'selected' : '' }}>Name: A-Z</option>
                                <option value="name-desc" {{ request('sort_by') == 'name' && request('sort_order') == 'desc' ? 'selected' : '' }}>Name: Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <x-product-card
                        :id="$product->id"
                        :name="$product->name"
                        :price="$product->price"
                        :originalPrice="$product->original_price"
                        :image="$product->primary_image ?? 'https://via.placeholder.com/300x300/EAB308/FFFFFF?text=Product'"
                        :category="$product->category->name ?? 'Furniture'"
                        :rating="$product->average_rating ?? 4.5"
                        :reviews="$product->reviews_count ?? 0"
                        :discount="$product->discount_percentage"
                    />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @else
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">No Products Found</h3>
                    <p class="text-gray-500 mb-4">Try adjusting your filters or search criteria</p>
                    <a href="{{ route('marketplace.index') }}" class="inline-block bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700 transition">
                        Clear Filters
                    </a>
                </div>
                @endif
            </main>
        </div>
    </div>
</section>

@push('scripts')
<script>
function updateSort(value) {
    const [sortBy, sortOrder] = value.split('-');
    const url = new URL(window.location.href);
    url.searchParams.set('sort_by', sortBy);
    url.searchParams.set('sort_order', sortOrder);
    window.location.href = url.toString();
}
</script>
@endpush
@endsection
