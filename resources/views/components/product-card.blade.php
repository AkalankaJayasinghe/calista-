@props(['id', 'name', 'price', 'originalPrice' => null, 'image', 'category' => 'Furniture', 'rating' => 5, 'reviews' => 0, 'discount' => null])

<div class="group bg-white rounded-sm overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
    {{-- Image Section --}}
    <div class="relative h-[300px] overflow-hidden bg-gray-100">
        <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

        {{-- Badges --}}
        @if($discount)
            <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wide">
                -{{ $discount }}%
            </span>
        @elseif($loop->iteration ?? 0 < 4)
            <span class="absolute top-3 left-3 bg-amber-600 text-white text-[10px] font-bold px-2 py-1 uppercase tracking-wide">
                New
            </span>
        @endif

        {{-- Hover Actions --}}
        <div class="absolute top-3 right-3 flex flex-col gap-2 translate-x-10 group-hover:translate-x-0 transition-transform duration-300">
            <button class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-amber-600 hover:text-white transition text-gray-600" title="Add to Wishlist">
                <i class="far fa-heart"></i>
            </button>
            <a href="{{ route('marketplace.product.quick-view', $id) }}" class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-amber-600 hover:text-white transition text-gray-600" title="Quick View">
                <i class="far fa-eye"></i>
            </a>
        </div>

        {{-- Add to Cart Button (Slide Up) --}}
        <div class="absolute bottom-0 left-0 w-full bg-white/95 backdrop-blur p-3 translate-y-full group-hover:translate-y-0 transition duration-300 border-t border-gray-100">
            <form action="{{ route('cart.add', $id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-xs font-bold uppercase tracking-widest hover:text-amber-600 transition flex justify-center items-center gap-2">
                    Add to Cart <i class="fas fa-shopping-bag"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="p-4 text-center">
        <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">{{ $category }}</p>
        <a href="{{ route('marketplace.product.show', ['slug' => Str::slug($name)]) }}" class="block">
            <h3 class="text-lg font-serif font-bold text-gray-900 group-hover:text-amber-600 transition truncate">{{ $name }}</h3>
        </a>

        {{-- Rating --}}
        <div class="flex justify-center items-center gap-1 my-2 text-[10px] text-amber-500">
            @for($i = 1; $i <= 5; $i++)
                <i class="{{ $i <= round($rating) ? 'fas' : 'far' }} fa-star"></i>
            @endfor
            <span class="text-gray-400 ml-1">({{ $reviews }})</span>
        </div>

        {{-- Price --}}
        <div class="flex justify-center items-center gap-2">
            @if($originalPrice)
                <span class="text-sm text-gray-400 line-through">Rs. {{ number_format($originalPrice) }}</span>
            @endif
            <span class="text-amber-600 font-bold text-lg">Rs. {{ number_format($price) }}</span>
        </div>
    </div>
</div>
