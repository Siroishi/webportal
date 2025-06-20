@extends('layouts.app')

@section('content')
    <section class="max-w-4xl mx-auto px-4 py-12">

        <div class="bg-white border border-[#E98074] rounded-xl shadow-md overflow-hidden">

            @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}"
                     alt="{{ $news->title }}"
                     class="w-full h-64 object-cover">
            @endif

            <div class="p-6">
                <h1 class="text-3xl font-extrabold text-[#E85A4F] mb-4"
                    style="font-family:'Oswald',sans-serif">
                    {{ $news->title }}
                </h1>


                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($news->categories as $category)
                        <span class="bg-[#EAE7DC] text-[#E85A4F] text-sm font-medium px-3 py-1 rounded">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>


                <div class="prose max-w-none text-[#4B4B4B]">
                    {!! $news->content !!}
                </div>


                <div class="mt-6 text-sm text-[#8E8D8A]">
                    Опубліковано: {{ $news->published_at?->format('d.m.Y H:i') }}
                </div>
            </div>
        </div>

    </section>
@endsection
