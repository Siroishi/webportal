@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($university->logo)
                <img src="{{ asset('storage/' . $university->logo) }}" alt="{{ $university->name }}" class="w-full h-64 object-contain bg-gray-100">
            @endif
            
            <div class="p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $university->name }}</h1>

                <div class="prose max-w-none mb-6">
                    {!! $university->description !!}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">Контактная информация</h2>
                        <ul class="space-y-2">
                            <li><strong>Адрес:</strong> {{ $university->address }}</li>
                            <li><strong>Телефон:</strong> {{ $university->phone }}</li>
                            <li><strong>Email:</strong> {{ $university->email }}</li>
                            <li><strong>Сайт:</strong> <a href="{{ $university->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $university->website }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-2">Факультеты</h2>
                        <ul class="space-y-2">
                            @foreach($university->faculties as $faculty)
                                <li class="flex items-center">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                    {{ $faculty->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 