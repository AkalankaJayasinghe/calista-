@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Marketplace', 'url' => route('marketplace.index')],
    ['label' => 'Living Room', 'url' => route('marketplace.category', 'living-room')],
    ['label' => 'Modern Sofa Set']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img src="https://via.placeholder.com/600x600/EAB308/FFFFFF?text=Main+Product" 
                         alt="Product" 
                         class="w-full rounded-lg mb-4"
                         id="mainImage">
                    <div class="grid grid-cols-4 gap-2">
                        @for($i = 1; $i <= 4; $i++)
                        <img src="https://via.placeholder.com/150x150/EAB308/FFFFFF?text=Img+{{ $i }}" 
                             alt="Thumbnail {{ $i }}" 
                             class="w-full h-24 object-cover rounded cursor-pointer border-2 border-transparent hover:border-yellow-600"
                             onclick="changeMainImage(this.src)">
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Premium Modern Sofa Set</h1>
                    
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-500">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600 ml-2">(4.5/5 - 127 reviews)</span>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-4xl font-bold text-gray-900">Rs. 145,000</span>
                            <span class="text-xl text-gray-500 line-through">Rs. 180,000</span>
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">20% OFF</span>
                        </div>
                        <p class="text-green-600 mt-2"><i class="fas fa-check-circle"></i> In Stock</p>
                    </div>

                    <div class="border-t border-b py-4 mb-6">
                        <h3 class="font-semibold mb-2">Product Description</h3>
                        <p class="text-gray-600">
                            Elegant and comfortable modern sofa set perfect for your living room. 
                            Made with high-quality materials and contemporary design. Features 
                            premium cushioning and durable fabric upholstery.
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Features:</h3>
                        <ul class="list-disc list-inside text-gray-600 space-y-1">
                            <li>Premium quality fabric upholstery</li>
                            <li>Solid wood frame construction</li>
                            <li>High-density foam cushioning</li>
                            <li>Easy to clean and maintain</li>
                            <li>5-year warranty included</li>
                        </ul>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Color:</h3>
                        <div class="flex space-x-2">
                            <button class="w-10 h-10 rounded-full bg-gray-800 border-2 border-yellow-600"></button>
                            <button class="w-10 h-10 rounded-full bg-blue-600 border-2 border-transparent hover:border-yellow-600"></button>
                            <button class="w-10 h-10 rounded-full bg-red-600 border-2 border-transparent hover:border-yellow-600"></button>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Quantity:</h3>
                        <div class="flex items-center space-x-2">
                            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">-</button>
                            <input type="number" value="1" min="1" class="w-16 text-center border border-gray-300 rounded">
                            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">+</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 mb-6">
                        <button class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-semibold transition">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button class="px-6 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-lg transition">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>

                    <button class="w-full bg-gray-900 hover:bg-gray-800 text-white py-3 rounded-lg font-semibold transition mb-6">
                        Buy Now
                    </button>

                    <!-- Seller Info -->
                    <div class="border-t pt-6">
                        <h3 class="font-semibold mb-3">Sold By:</h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    FS
                                </div>
                                <div>
                                    <h4 class="font-semibold">Furniture Store</h4>
                                    <div class="flex text-yellow-500 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="text-gray-600 ml-1">(4.9)</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="text-yellow-600 hover:underline">Visit Store</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="mt-12">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="border-b">
                    <div class="flex space-x-8 px-6">
                        <button class="py-4 border-b-2 border-yellow-600 font-semibold">Description</button>
                        <button class="py-4 border-b-2 border-transparent hover:border-gray-300">Specifications</button>
                        <button class="py-4 border-b-2 border-transparent hover:border-gray-300">Reviews (127)</button>
                        <button class="py-4 border-b-2 border-transparent hover:border-gray-300">Shipping Info</button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">Product Description</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Transform your living space with our Premium Modern Sofa Set. This exquisite piece combines 
                        contemporary design with exceptional comfort, making it the perfect centerpiece for your home.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Crafted with meticulous attention to detail, this sofa features a solid wood frame that ensures 
                        durability and longevity. The high-density foam cushioning provides superior comfort, while the 
                        premium fabric upholstery adds a touch of elegance to any room.
                    </p>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-12">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-bold mb-6">Customer Reviews</h3>
                
                @for($i = 1; $i <= 3; $i++)
                <div class="border-b pb-6 mb-6 last:border-b-0">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                C{{ $i }}
                            </div>
                            <div>
                                <h4 class="font-semibold">Customer {{ $i }}</h4>
                                <div class="flex text-yellow-500 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-500 text-sm">2 days ago</span>
                    </div>
                    <p class="text-gray-600">
                        Excellent quality and very comfortable! The delivery was on time and the product exceeded my expectations. 
                        Highly recommended for anyone looking for modern furniture.
                    </p>
                </div>
                @endfor

                <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold transition">
                    Load More Reviews
                </button>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-12">
            <h3 class="text-2xl font-bold mb-6">Related Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @for($i = 1; $i <= 4; $i++)
                <x-product-card 
                    :id="$i + 100"
                    :name="'Related Product ' . $i"
                    :price="120000 + ($i * 10000)"
                    :image="'https://via.placeholder.com/300x300/EAB308/FFFFFF?text=Related+' . $i"
                    :rating="4.5"
                    :reviews="rand(20, 80)"
                />
                @endfor
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function changeMainImage(src) {
    document.getElementById('mainImage').src = src;
}
</script>
@endpush
@endsection
