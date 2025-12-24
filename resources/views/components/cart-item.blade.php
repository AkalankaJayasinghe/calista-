<div class="flex items-center space-x-4 border-b pb-4">
    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded">
    <div class="flex-1">
        <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
        <p class="text-gray-600 text-sm">{{ $item['seller'] }}</p>
        <p class="text-yellow-600 font-bold mt-1">Rs. {{ number_format($item['price']) }}</p>
    </div>
    <div class="flex items-center space-x-2">
        <button class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded" onclick="updateQuantity({{ $item['id'] }}, -1)">-</button>
        <span class="w-12 text-center font-semibold">{{ $item['quantity'] }}</span>
        <button class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded" onclick="updateQuantity({{ $item['id'] }}, 1)">+</button>
    </div>
    <div class="text-right">
        <p class="font-bold text-gray-900">Rs. {{ number_format($item['price'] * $item['quantity']) }}</p>
        <button class="text-red-500 hover:text-red-700 text-sm mt-2" onclick="removeItem({{ $item['id'] }})">
            <i class="fas fa-trash"></i> Remove
        </button>
    </div>
</div>
