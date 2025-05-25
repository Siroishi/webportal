@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">База знаний</h1>

    <x-search route="knowledge.index" placeholder="Поиск по базе знаний..." />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($knowledge as $item)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                @endif
                
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('knowledge.show', $item) }}" class="hover:text-blue-600">
                            {{ $item->title }}
                        </a>
                    </h2>
                    
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($item->categories as $category)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <p class="text-gray-600 mb-4">
                        {{ Str::limit(strip_tags($item->content), 150) }}
                    </p>

                    <div class="text-sm text-gray-500">
                        {{ $item->published_at?->format('d.m.Y H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $knowledge->links() }}
    </div>
</div>
@endsection 