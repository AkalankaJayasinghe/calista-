@props(['items'])

<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-6">
        <nav class="flex text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-amber-600 transition">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                </li>
                @foreach($items as $item)
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-xs mx-2 text-gray-400"></i>
                            @if(isset($item['url']))
                                <a href="{{ $item['url'] }}" class="hover:text-amber-600 transition">{{ $item['label'] }}</a>
                            @else
                                <span class="text-amber-600 font-medium">{{ $item['label'] }}</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
