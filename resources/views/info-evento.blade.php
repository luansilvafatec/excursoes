<x-layout.layout-base>

    <div class="bg-white">
        <div class="relative h-28 bg-black">
            <img class="h-28 w-full object-cover"
                src="https://tiinside.com.br/wp-content/uploads/2023/10/brasil-game-show-2022-e1696505407788.jpg"
                alt="" />
            <div class="absolute inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 px-10">
                <span class="grow border-2 border-white"></span>
                <h1 class="mx-9 text-center font-roboto text-xl font-bold leading-5 text-white xs:text-4xl">
                    {{ $evento->titulo_completo }}</h1>
                <span class="grow border-2 border-white"></span>
            </div>
        </div>
        <div class="flex w-full justify-center">
            <div class="flex rounded-b-2xl bg-[#7CB342] px-5 py-4 text-xl font-bold shadow-lg">
                {{ $evento->dia_mes . ' de ' . $evento->mes . ' - ' . $evento->dia_semana }}</div>
        </div>
        <div class="mt-10 flex px-5 sm:px-12">
            <div class="justify-between lg:flex lg:space-x-8">
                <div class="lg:w-1/2">
                    <div class="content flex flex-col items-center xs:block">
                        <div class="float-left">
                            <img class="float-left max-w-40 mb-3 mr-4 aspect-square object-cover"
                                src="{{ $evento->foto_card }}" alt="" />
                        </div>
                        <div class="text-justify">
                            <p>{{ $evento->descricao_longa }}</p>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    <div class="mt-6 flex flex-col items-center justify-center">
                        <div class="flex items-center rounded-xl bg-[#EF6C00] px-8 py-4 text-xl font-bold text-white">
                            Corra e garanta sua vaga</div>
                        <div
                            class="flex flex-col items-center rounded-b-2xl bg-[#00897B] px-8 py-2 text-xl font-bold text-white">
                            <span class="text-sm leading-3">por</span> R$ {{ $evento->valor_formatado }}
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center">
                        <div class="flex w-full justify-center">
                            <div class="mr-3 border-e pr-3 pt-5 text-end">
                                <div class="mb-2 font-bold">O que está incluso</div>
                                <div class="leading-4">
                                    Transporte ida e volta<br />
                                    @if ($evento->ingresso_incluso)
                                        <b>+Ingresso para o evento</b>
                                    @endif
                                </div>
                            </div>
                            <div class="mr-3 pr-3 pt-5 text-center">
                                <div class="mb-2 font-bold">Pagamento</div>
                                <div class="leading-4">
                                    Dinheiro à vista<br />
                                    Pix à vista<br />
                                    Dinheiro parcelado<br />
                                    Pix parcelado
                                </div>
                            </div>
                        </div>
                        <div class="pt-5 text-start">
                            <div class="mb-2 border-t font-bold">Horários</div>
                            <div class="leading-4">
                                {{ $evento->saida_fatec_formatada }} - Saída da Faculdade<br />
                                {{ $evento->chegada_evento_formatada }} - <b>*</b>Chegada no evento<br />
                                {{ $evento->saida_evento_formatada }} - <b>*</b>Saída do evento<br />
                                {{ $evento->chegada_fatec_formatada }} - <b>*</b>Chegada na Faculdade<br /><br />
                                <b>*</b>Horários previstos
                            </div>
                        </div>
                    </div>
                    <div class="jus my-4 flex items-center">
                        <img class="rounded-full" src="https://via.placeholder.com/150x150" alt="imagem"
                            width="150" height="150" />
                        <div class="ml-8">
                            <div class="font-bold">Professor responsável</div>
                            <div>{{ $evento->user->nome }}</div>
                        </div>
                    </div>
                </div>
                <div class="relative w-full justify-center lg:w-1/2 grow mb-10">
                    <div class="sticky top-0 grow max-w-lg m-auto">
                        <div class="flex w-full justify-center">
                            <div class="flex rounded-t-2xl bg-[#0396D8] px-6 py-3 text-center text-lg">
                                @if ($evento->possui_vagas)
                                    <span class="mr-1 font-bold">{{ $evento->vagas_disponiveis }}</span> vagas
                                    disponíveis
                                @else
                                    <span class="mr-1 font-bold">ESGOTADO</span>
                                @endif
                            </div>
                        </div>
                        <div class="aspect-square rounded-3xl bg-[#283337]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout-base>
