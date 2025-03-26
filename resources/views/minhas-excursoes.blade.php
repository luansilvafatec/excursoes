<x-layout.layout-base>

    <div class="sm:px-10 sm:py-7">
        <div class="min-h-96 w-full bg-white p-4 sm:rounded-2xl">
            <div class="flex items-center justify-center text-center">
                <span class="ml-10 grow border-y border-black"></span>
                <div class="px-10 text-3xl font-bold">Minhas excursões</div>
                <span class="mr-10 grow border-y border-black"></span>
            </div>

            @if ($user->eventos()->count() == 0)
                <div class="mt-5 text-center">
                    <div class="flex items-center justify-center space-x-2 p-4 text-2xl font-semibold text-gray-700">
                        <span>🧐</span>
                        Nenhuma Excursão Inscrita Ainda?
                        <span>🧐</span>
                    </div>

                    <p class="text-lg text-gray-600">
                        Parece que você ainda não se inscreveu em nenhuma das nossas excursões.<br />
                        Não perca a chance de viver experiências incríveis fora da sala de aula!<br />

                        Navegue pelas nossas excursões, escolha a sua favorita e junte-se a nós em aventuras
                        inesquecíveis!
                    </p>

                    <p class="mt-6">
                        <a class="font-bold text-blue-500 underline" href="{{ route('home') }}">Clique aqui e
                            inscreva-se agora</a>
                        para garantir sua vaga!
                    </p>
                </div>
            @else
                <!-- Lista excursões -->
                <div class="mt-5 flex flex-col items-center py-4 space-y-6">
                    @foreach ($user->eventos as $evento)
                        <x-card-minhas-excursoes :evento="$evento" :user="$user"></x-card-minhas-excursoes>
                    @endforeach

                </div>
            @endif
        </div>
    </div>

</x-layout.layout-base>
