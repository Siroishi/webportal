@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">


        <h1 class="text-center font-extrabold text-[#E85A4F] text-4xl mb-10"
            style="font-family:'Oswald',sans-serif">
            ОСТАННІ НОВИНИ
        </h1>

        <x-search route="news.index" placeholder="Пошук по новинах..." />

        @php
            $first = $news->first();
            $nextTwo = $news->slice(1, 2);
            $rest = $news->slice(3);
        @endphp


        <div class="grid md:grid-cols-3 gap-10 mb-16">

            @if($first)
                <div class="md:col-span-2 rounded-xl overflow-hidden shadow border border-[#E98074] bg-white">
                    @if($first->image)
                        <img src="{{asset('storage/' . $first->image) }}"
                             alt="{{ $first->title }}" class="w-full h-80 object-cover">
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2 text-[#E85A4F]">
                            <a href="{{ route('news.show', $first) }}" class="hover:underline">
                                {{ $first->title }}
                            </a>
                        </h2>

                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($first->categories as $category)
                                <span class="bg-[#EAE7DC] text-[#E85A4F] text-xs font-medium px-2 py-1 rounded">
                            {{ $category->name }}
                        </span>
                            @endforeach
                        </div>

                        <p class="text-[#8E8D8A] text-sm mb-4">
                            {{ Str::limit(strip_tags($first->content), 200) }}
                        </p>

                        <div class="text-xs text-[#8E8D8A]">
                            {{ $first->published_at?->format('d.m.Y H:i') }}
                        </div>
                    </div>
                </div>
            @endif


            <div class="flex flex-col gap-8">
                @foreach($nextTwo as $item)
                    <div class="flex gap-4">
                        @if($item->image)
                            <a href="{{ route('news.show', $item) }}">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                     class="w-40 h-28 object-cover rounded" alt="{{ $item->title }}">
                            </a>
                        @endif

                        <div>
                            <h3 class="font-semibold text-base leading-tight mb-1">
                                <a href="{{ route('news.show', $item) }}" class="hover:text-[#E85A4F]">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-[#8E8D8A]">
                                {{ $item->published_at?->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="grid lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach($rest as $item)
                    <div class="bg-white border border-[#E98074] rounded-xl shadow-md overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2 text-[#E85A4F]">
                                <a href="{{ route('news.show', $item) }}" class="hover:underline">
                                    {{ $item->title }}
                                </a>
                            </h3>

                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($item->categories as $category)
                                    <span class="bg-[#EAE7DC] text-[#E85A4F] text-xs font-medium px-2 py-1 rounded">
                                    {{ $category->name }}
                                </span>
                                @endforeach
                            </div>

                            <p class="text-[#8E8D8A] text-sm mb-4">
                                {{ Str::limit(strip_tags($item->content), 120) }}
                            </p>

                            <div class="text-xs text-[#8E8D8A]">
                                {{ $item->published_at?->format('d.m.Y H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            @isset($sidebarWeek)
                <aside class="sticky top-24 h-fit bg-white border border-[#E98074] p-6 rounded-xl shadow">
                    <h3 class="text-[#E85A4F] font-bold mb-4" style="font-family:'Oswald',sans-serif">
                        Новини минулого тижня
                    </h3>
                    <ul class="divide-y divide-[#EAE7DC]">
                        @foreach($sidebarWeek as $item)
                            <li class="py-3">
                                <a href="{{ route('news.show', $item) }}"
                                   class="block hover:text-[#E85A4F] leading-snug">
                                    {{ $item->title }}
                                </a>
                                <span class="text-xs text-[#8E8D8A]">
                            {{ $item->published_at?->format('d.m.Y H:i') }}
                        </span>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            @endisset
        </div>


        <div class="mt-12 text-center">
            {{ $news->links() }}
        </div>
    </section>
@endsection
