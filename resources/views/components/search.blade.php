@props(['route','placeholder' => 'Пошук…',
])

<form action="{{ route($route) }}" method="GET" class="my-10">
    <div class="flex justify-center">
        <div class="relative w-full max-w-3xl">
            {{-- поле вводу --}}
            <input  type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ $placeholder }}"
                    class="w-full pl-6 pr-12 py-2 rounded-full
                           border border-[#E98074] bg-transparent
                           text-[#E85A4F] placeholder-[#8E8D8A]
                           focus:outline-none focus:border-[#E85A4F]" />

            {{-- кнопка-лупа --}}
            <button type="submit"
                    class="absolute inset-y-0 right-4 flex items-center group cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 stroke-[#E85A4F]
                            transition-transform duration-150
                            group-hover:scale-120"
                     fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>
        </div>
    </div>
</form>
