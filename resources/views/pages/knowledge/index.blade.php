{{-- resources/views/knowledge/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-center font-extrabold text-[#E85A4F] text-4xl mb-10"
            style="font-family:'Oswald',sans-serif">
            БАЗА ЗНАНЬ
        </h1>

        <x-search route="knowledge.index" placeholder="Пошук по базі знань..." />

        <div class="flex flex-col gap-6">
            @foreach ($knowledge as $item)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden p-4" style="border: 1px solid #E98074;">
                    <div class="flex flex-col md:flex-row gap-4 items-start">
                        @if ($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 alt="{{ $item->title }}"
                                 class="w-50 h-50 object-cover rounded-md flex-shrink-0">
                        @endif

                        <div class="flex-1">
                            <h2 class="text-2xl font-semibold mb-2 text-[#E85A4F]">
                                <a href="{{ route('knowledge.show', $item) }}" class="hover:underline">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($item->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                    {{ $category->name }}
                                </span>
                                @endforeach
                            </div>

                            {{-- ↓ головна зміна: декодуємо HTML-сутності, тоді обмежуємо довжину --}}
                            @php
                                $excerpt = Str::limit(
                                    html_entity_decode(strip_tags($item->content)),
                                    200
                                );
                            @endphp
                            <p class="text-gray-700 mb-4">{{ $excerpt }}</p>

                            <div class="text-sm text-gray-500">
                                {{ optional($item->published_at)->format('d.m.Y H:i') }}
                            </div>
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
