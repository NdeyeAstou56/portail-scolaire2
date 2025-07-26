@props(['title', 'text', 'icon', 'color' => 'blue', 'link'])

<a href="{{ $link }}" class="bg-{{ $color }}-50 hover:bg-{{ $color }}-100 transition rounded-lg p-5 shadow flex items-center gap-4">
    <img src="{{ $icon }}" alt="{{ $title }}" class="w-10 h-10">
    <div>
        <h3 class="font-bold text-lg text-{{ $color }}-700">{{ $title }}</h3>
        <p class="text-sm text-gray-600">{{ $text }}</p>
    </div>
</a>
