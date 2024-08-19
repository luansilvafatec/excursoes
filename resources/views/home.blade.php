<x-layout.layout-base>
    <section class="flex flex-col items-center justify-center bg-gradient-to-b from-white p-4 text-center">
        <h1 class="font-roboto text-xl font-bold leading-6 sm:text-2xl">Explore, Aprenda e Divirta-se!</h1>
        <p class="mt-4 max-w-[40rem] text-center leading-5">Participe de excursões cheias de conhecimento e
            entretenimento: Melhore suas habilidades e aproveite cada momento.</p>
    </section>
    <section>
        <div class="flex items-center justify-center px-8">
            <span class="grow border border-black"></span>
            <h1 class="mx-4 text-center font-roboto text-xl leading-6 sm:text-2xl">Excursões em Andamento</h1>
            <span class="grow border border-black"></span>
        </div>
        <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($eventos as $evento)
                <x-card-home :evento="$evento"></x-card-home>
            @endforeach
        </div>
    </section>
</x-layout.layout-base>
