
@extends('layouts.app')

@section('content')
    <main class="bg-[#EAE7DC] antialiased">

        {{-- HERO ------------------------------------------------------------- --}}
        <section class="max-w-4xl mx-auto text-center py-16 px-6">
            <h1 class="text-[#E85A4F] text-5xl md:text-6xl font-extrabold leading-tight"
                style="font-family:'Oswald',sans-serif">
                Є ПИТАННЯ? ТОДІ ТОБІ<br>САМЕ СЮДИ
            </h1>

            <p class="mt-6 text-[#8E8D8A] text-base md:text-lg leading-relaxed">
                Ми завжди поруч, щоб допомогти вам зробити правильний вибір і&nbsp;успішно пройти навчальний шлях…
            </p>
        </section>

        {{-- LAST NEWS CARD ---------------------------------------------------- --}}
        <section class="max-w-5xl mx-auto py-8 px-6">
            <div
                class="flex flex-col md:flex-row items-stretch rounded-3xl border border-[#E98074] bg-[#FDFCF9] shadow-md">
                <div class="p-8 flex-1">
                    <h2 class="uppercase text-lg font-bold text-[#E85A4F]"
                        style="font-family:'Oswald',sans-serif">
                        Останні новини інституту
                    </h2>

                    <p class="mt-4 text-sm text-[#8E8D8A] leading-relaxed">
                        Будьте в курсі всіх подій нашого інституту! Дізнавайтеся про нові наукові досягнення, студентські
                        ініціативи, важливі заходи та цікаві можливості для розвитку…
                    </p>

                    <a href="{{ route('news.index') }}"
                       class="inline-block mt-6 rounded border border-[#E85A4F] px-6 py-2 text-sm font-semibold
                          text-[#E85A4F] hover:bg-[#E85A4F]/10"
                       style="font-family:'Oswald',sans-serif">
                        Дізнатися більше
                    </a>
                </div>

                {{-- замініть шлях до зображення на реальне --}}
                <div class="md:w-72 md:flex-shrink-0">
                    <img src="{{ Vite::asset('resources/images/news-preview.jpg') }}"
                         alt="Latest news"
                         class="h-full w-full object-cover rounded-b-3xl md:rounded-b-none md:rounded-r-3xl">
                </div>
            </div>
        </section>

        {{-- KNOWLEDGE BASE ---------------------------------------------------- --}}
        <section class="py-20 px-6">
            <h2 class="text-center text-4xl md:text-5xl font-extrabold text-[#E85A4F]"
                style="font-family:'Oswald',sans-serif">
                БАЗА ЗНАНЬ
            </h2>

            <div class="flex justify-center mt-6">
                <a href="{{ route('knowledge.index') }}"
                   class="rounded border border-[#E85A4F] px-8 py-2 font-semibold text-sm uppercase text-[#E85A4F]
                      hover:bg-[#E85A4F]/10"
                   style="font-family:'Oswald',sans-serif">
                    Перейти до знань!
                </a>
            </div>

            <p class="max-w-3xl mx-auto text-center mt-6 text-[#8E8D8A] text-sm leading-relaxed">
                Отримайте доступ до безцінних ресурсів! У нашій базі знань зібрані навчальні матеріали, дослідницькі статті
                та корисні інструменти для студентів і викладачів…
            </p>

            <h3 class="text-center mt-12 text-xl font-bold uppercase text-[#E85A4F]"
                style="font-family:'Oswald',sans-serif">
                Лише тут ви можете отримати таку цінну інформацію, а саме:
            </h3>

            {{-- картки 8 × (2 рядки × 4 колонки) --}}
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- === CARD шаблон === --}}
                @php
                    $cards = [
                        ['title'=>'Навчальні матеріали','items'=>['Лекції, конспекти та презентації','Практичні й лабораторні','Відеоуроки та вебінари']],
                        ['title'=>'Методичні посібники','items'=>['Інструкції до завдань','Поради щодо підготовки','Рекомендована література']],
                        ['title'=>'Наукові публікації','items'=>['Статті викладачів та студентів','Дослідницькі проєкти','Звіти конференцій']],
                        ['title'=>'Електронні підручники','items'=>['Підручники за спеціальностями','Доступ до e-бібліотек','Корисна література']],
                        ['title'=>'Шаблони документів','items'=>['Звітність для курсових','Приклад структури робіт','Методички']],
                        ['title'=>'Інтерактивні інструменти','items'=>['Онлайн-тести','Лабораторні симуляції','Навчальні програми']],
                        ['title'=>'Посилання на ресурси','items'=>['Наукові журнали','Онлайн-бібліотеки','Навчальні платформи']],
                        ['title'=>'Форум для обговорення','items'=>['Чат для студентів','Відповіді на часті питання','Форум для викладачів']],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="rounded-xl border border-[#E98074] bg-white p-6 shadow-sm">
                        <h4 class="text-[#E85A4F] font-bold mb-4"
                            style="font-family:'Oswald',sans-serif">
                            {{ $card['title'] }}
                        </h4>
                        <ul class="space-y-2 text-sm text-[#8E8D8A] marker:text-[#E85A4F] list-disc ps-5">
                            @foreach ($card['items'] as $it)
                                <li>{{ $it }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            {{-- КНОПКИ-КАТЕГОРІЇ ------------------------------------------------ --}}
            <div class="mt-16 flex flex-col items-center space-y-6">
                @foreach (['Комп’ютерні науки','Прикладна механіка','Менеджмент','Маркетинг','Фінанси'] as $cat)
                    <a href="#"
                       class="w-80 rounded-lg border border-[#E98074] py-3 text-center font-semibold uppercase
                          text-[#E85A4F] hover:bg-[#E85A4F]/10"
                       style="font-family:'Oswald',sans-serif">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
