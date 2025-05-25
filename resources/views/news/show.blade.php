@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover">
            @endif
            
            <div class="p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($news->categories as $category)
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="prose max-w-none">
                    {!! $news->content !!}
                </div>

                <div class="mt-6 text-sm text-gray-500">
                    Опубликовано: {{ $news->published_at?->format('d.m.Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 