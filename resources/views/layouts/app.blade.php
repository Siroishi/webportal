<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="min-h-screen antialiased bg-[#EAE7DC]">
<header class="bg-[#EAE7DC] shadow-sm">
    <div class="mx-auto max-w-7xl flex items-center justify-between py-4 px-6">
        {{-- логотип --}}
        <a href="{{ route('home') }}"
           class="flex items-center gap-3 rounded-2xl border border-[#E98074] bg-[#EAE7DC] px-4 py-2 shadow-sm">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="EDU HELP" class="h-10 w-10 shrink-0">
            <span style="font-family:'Oswald',sans-serif"
                  class="text-2xl font-extrabold tracking-wide text-[#E85A4F]">
                EDU HELP
            </span>
        </a>

        {{-- навигация --}}
        <nav class="hidden md:flex items-center gap-8 rounded-md border border-[#E98074] bg-[#EAE7DC] px-8 py-2 shadow-sm">
            <a href="{{ route('news.index') }}"
               class="uppercase text-sm font-semibold tracking-widest
                      {{ request()->routeIs('news.*') ? 'text-[#E85A4F]' : 'text-[#8E8D8A] hover:text-[#E85A4F]' }}"
               style="font-family:'Oswald',sans-serif">
                Новини
            </a>
            <a href="{{ route('universities.index') }}"
               class="uppercase text-sm font-semibold tracking-widest
                      {{ request()->routeIs('universities.*') ? 'text-[#E85A4F]' : 'text-[#8E8D8A] hover:text-[#E85A4F]' }}"
               style="font-family:'Oswald',sans-serif">
                ВНЗІ
            </a>

            <a href="{{ route('knowledge.index') }}"
               class="uppercase text-sm font-semibold tracking-widest
                      {{ request()->routeIs('knowledge.*') ? 'text-[#E85A4F]' : 'text-[#8E8D8A] hover:text-[#E85A4F]' }}"
               style="font-family:'Oswald',sans-serif">
                База знань
            </a>

            <a href="#"
               class="uppercase text-sm font-semibold tracking-widest
               text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]"
{{--                      {{ request()->routeIs('cabinet.*') ? 'text-[#E85A4F]' : 'text-[#8E8D8A] hover:text-[#E85A4F]' }}"--}}
               style="font-family:'Oswald',sans-serif">
                Кабінет
            </a>
        </nav>

        {{-- Log-in / Registered --}}
        <div class="hidden lg:flex items-stretch rounded-md border border-[#E98074] text-[#E85A4F]">
            <a href="/login"
               class="px-6 py-2 font-semibold uppercase tracking-wide hover:bg-[#E85A4F]/10"
               style="font-family:'Oswald',sans-serif">
                Log-in
            </a>
            <div class="w-px bg-[#E98074]"></div>
            <a href="/registragion"
               class="px-6 py-2 font-semibold uppercase tracking-wide hover:bg-[#E85A4F]/10"
               style="font-family:'Oswald',sans-serif">
                Registered
            </a>
        </div>

        {{-- бургер для mobile --}}
        <button x-data="{ open: false }" @click="open = !open"
                class="md:hidden inline-flex items-center justify-center rounded-md border border-[#E98074] bg-[#EAE7DC] p-2 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E85A4F]" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- мобильное меню --}}
    <nav x-cloak x-show="open" x-transition
         class="md:hidden space-y-2 bg-[#EAE7DC] px-6 pb-6 pt-2 shadow-inner">
        <a href="{{ route('news.index') }}"
           class="block rounded-md px-4 py-2 text-sm font-semibold uppercase tracking-widest
                  {{ request()->routeIs('news.*') ? 'bg-[#E85A4F]/10 text-[#E85A4F]' : 'text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]' }}"
           style="font-family:'Oswald',sans-serif">
            Новини
        </a>
        <a href="{{ route('universities.index') }}"
           class="block rounded-md px-4 py-2 text-sm font-semibold uppercase tracking-widest
                  {{ request()->routeIs('universities.*') ? 'bg-[#E85A4F]/10 text-[#E85A4F]' : 'text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]' }}"
           style="font-family:'Oswald',sans-serif">
            Університети
        </a>
        <a href="{{ route('knowledge.index') }}"
           class="block rounded-md px-4 py-2 text-sm font-semibold uppercase tracking-widest
                  {{ request()->routeIs('knowledge.*') ? 'bg-[#E85A4F]/10 text-[#E85A4F]' : 'text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]' }}"
           style="font-family:'Oswald',sans-serif">
            База знань
        </a>
        <a href="#"
           class="block rounded-md px-4 py-2 text-sm font-semibold uppercase tracking-widest
           text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]"
{{--                  {{ request()->routeIs('cabinet.*') ? 'bg-[#E85A4F]/10 text-[#E85A4F]' : 'text-[#8E8D8A] hover:bg-[#E85A4F]/5 hover:text-[#E85A4F]' }}"--}}
           style="font-family:'Oswald',sans-serif">
            Кабінет
        </a>
    </nav>
</header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>
    {{-- футер --}}
    <footer class="bg-[#2D2D2D] border-t border-[#E98074] mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-[#8E8D8A] text-sm"
         style="font-family: 'Oswald', sans-serif">

        <!-- Логотип и слоган -->
        <div>
            <div class="flex items-center gap-3 mb-3">

                <span class="text-xl font-bold text-[#E85A4F]">EDU HELP</span>
            </div>
            <p class="text-[#8E8D8A]">
                Допомагаємо зробити правильний вибір у світі освіти.
            </p>
        </div>

        <!-- Меню -->
        <div class="space-y-2">
            <h3 class="uppercase font-semibold tracking-wide text-[#E85A4F]">Навігація</h3>
            <ul class="space-y-1">
                <li><a href="{{ route('news.index') }}" class="hover:text-[#E85A4F] transition">Новини</a></li>
                <li><a href="{{ route('universities.index') }}" class="hover:text-[#E85A4F] transition">Університети</a></li>
                <li><a href="{{ route('knowledge.index') }}" class="hover:text-[#E85A4F] transition">База знань</a></li>
                <li><a href="#" class="hover:text-[#E85A4F] transition">Кабінет</a></li>
            </ul>
        </div>

        <!-- Контакти -->
        <div class="space-y-2">
            <h3 class="uppercase font-semibold tracking-wide text-[#E85A4F]">Контакти</h3>
            <p>Email: <a href="mailto:support@eduhelp.ua" class="hover:text-[#E85A4F] transition">support@eduhelp.ua</a></p>
            <p>Телефон: <a href="tel:+380991112233" class="hover:text-[#E85A4F] transition">+38 (099) 111-22-33</a></p>
        </div>
    </div>

    <!-- Низ футера -->
    <div class="text-center text-xs text-[#8E8D8A] py-4">
        © {{ date('Y') }} EDU HELP. Всі права захищено.
    </div>
</footer>

</body>
</html>
