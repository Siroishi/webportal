@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-center font-extrabold text-[#E85A4F] text-4xl mb-10"
        style="font-family:'Oswald',sans-serif">
        УНІВЕРСИТЕТИ
    </h1>

    <x-search route="universities.index" placeholder="Пошук по університетам..." />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($universities as $university)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($university->logo)
                    <img src="{{ asset('storage/' . $university->logo) }}" alt="{{ $university->name }}" class="w-full h-48 object-contain bg-gray-50">
                @endif

                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('universities.show', $university) }}" class="hover:text-blue-600">
                            {{ $university->name }}
                        </a>
                    </h2>

                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($university->description, 150) }}
                    </p>

                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Факультети:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($university->faculties as $faculty)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">
                                    {{ $faculty->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $university->address }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $universities->links() }}
    </div>
</div>
@endsection
