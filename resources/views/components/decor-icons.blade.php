@props([
    // кількість повторів кожного SVG; можна передати ззовні
    'books'   => 4,
    'caps'    => 3,
    'papers'  => 2,
])

@php
    // допоміжний масив [src, width, classExtra]
    $sprites = [
        ['images/decor/book.svg',  'w-10', 'rotate-12'],
        ['images/decor/cap.svg',   'w-10', '-rotate-6'],
        ['images/decor/paper.svg', 'w-10', 'rotate-3'],
    ];
    $all = [];
    foreach (['book' => $books,'cap'=>$caps,'paper'=>$papers] as $k=>$qty) {
        for ($i = 0; $i < $qty; $i++) {
            $all[] = $sprites[$k === 'book' ? 0 : ($k === 'cap' ? 1 : 2)];
        }
    }
@endphp

<div class="pointer-events-none absolute inset-0 overflow-hidden select-none">
    @foreach ($all as $i => [$src,$w,$extra])
        <img src="{{ Vite::asset('resources/'.$src) }}"
             class="absolute {{ $w }} {{ $extra }} opacity-30"
             style="
               top:  {{ rand(4,96) }}%;
               left: {{ rand(0,90) }}%;
               transform: translate(-50%,-50%) {{ $extra ? ' '.$extra : '' }};
             "
             alt="">
    @endforeach
</div>
