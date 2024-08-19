<a href="{{route('evento', $evento)}}" class="flex flex-col items-center justify-center pb-4">
    <div class="relative">
        <div
            class="absolute top-3 w-32 rounded-ee-2xl bg-[#EF6C00] pb-0.5 text-center text-sm font-bold text-white shadow-lg xs:w-44 xs:text-base">
            {{ $evento->dia_mes }} - {{ $evento->mes }}<div class="-mt-1 text-xs">({{ $evento->dia_semana }})</div>
        </div>
        <img class="rounded-t-2xl aspect-video object-cover" src="{{ $evento->foto_card }}" alt="" />
    </div>
    <div class="flex flex-col pb-5 pt-2 bg-white shadow-lg rounded-b-2xl w-full">
        <div class="my-4 flex items-center font-roboto text-xl"><span class="mr-2 h-0 w-8 border border-black"></span>
            {{ $evento->titulo }}</div>
        <p class="line-clamp-7 px-7 text-justify leading-5 xs:line-clamp-5">{{ $evento->descricao_curta }}</p>
        <span class="my-5 flex justify-center text-2xl font-bold">R$ {{ $evento->valor_formatado }}</span>
        {{-- <div class="self-center rounded-lg bg-[#00897B] px-8 py-3 text-center font-bold text-white text-xl">
            @if ($evento->possui_vagas)
                Quero ir
            @else
                Avise-me
            @endif
        </div> --}}
    </div>
    @if ($evento->possui_vagas)
        <div
            class="bg-[#7CB342] rounded-b-2xl text-black px-10 py-3 text-center leading-4 text-xl font-medium shadow-lg sm:px-11">
            <b>{{ $evento->vagas_disponiveis }}</b> vagas <div class="text-base">disponíveis</div>
        </div>
    @else
        <div
            class="bg-[#7CB342] rounded-b-2xl text-black px-10 py-3 text-center leading-4 text-xl font-medium shadow-lg sm:px-11">
            <b>Esgotado!</b> <div class="text-base">lista de espera</div>
        </div>
    @endif
</a>
