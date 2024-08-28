<div class=" p-6 text-white text-center h-full">
    @if ($etapa == 1)
        <div id="1" wire:transition.scale.origin.top class="flex flex-col items-center justify-center h-full">
            <p class="text-2xl">Não perca essa oportunidade!</p>

            <p class="mt-4">Faça sua pré-reserva para participar. Estamos ansiosos para compartilhar essa experiência
                incrível com você!</p>

            <button wire:click="preReserva" class="p-4 mt-10 font-bold text-2xl rounded-md my-auto bg-[#00897B]">Pré
                reserva</button>
        </div>
    @elseif ($etapa == 2)
        <div id="2"
            class="flex flex-col items-center justify-center h-full transition ease-out duration-700 transform opacity-100"
            wire:transition.scale.origin.top>
            <p class="text-2xl">Pré Reserva efetuada!</p>

            <p class="mt-4">Você tem até dia {{ $limiteReserva }} para efetuar o pagamento parcial ou integral para
                poder
                garantir a sua
                vaga.</p>

            <button wire:click="pagarPix" class="p-4 mt-10 font-bold text-2xl rounded-md my-auto bg-[#00897B]">Pagar com
                PIX</button>
        </div>
    @elseif($etapa == 3)
        <div id="3"
            class="flex flex-col items-center justify-center h-full transition ease-out duration-700 transform opacity-100"
            wire:transition.scale.origin.top>
            <p class="text-2xl">Pagamento com PIX!</p>

            <p class="mt-4">Você pode efetuar o pagamento total ou parcial do valor. O valor total deve ser pago até
                dia 20/09</p>

            <p class="mt-4">Realize o pagamento efetuando um PIX para:</p>

            <div class="mt-4 w-full" x-data="{
                link: 'luan.silva@fatecourinhos.edu.br',
                copied: false,
                timeout: null,
                copy() {
                    $clipboard(this.link)

                    this.copied = true

                    clearTimeout(this.timeout)

                    this.timeout = setTimeout(() => {
                        this.copied = false
                    }, 3000)
                }
            }">
                <div class="flex items-center justify-center w-full">
                    <input class="rounded-lg bg-inherit w-56 mr-2" type="text" id="referral_code"
                        value="luan@fatecourinhos.edu.br" readonly />
                    <button x-on:click="copy"
                        x-html="!copied ? `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75' />
                        </svg>
                        ` : `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6 stroke-green-500 transition-all'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                        </svg>
                        `">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 stroke-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                        </svg>
                    </button>
                </div>
            </div>

            <p class="mt-4">Após o pagamento envie seu comprovante para:</p>

            <div class="flex items-center justify-center w-full mt-2">
                <input class="rounded-lg bg-inherit w-56 mr-2" type="text" id="referral_code"
                    value="(14) 9 9707-7987" readonly />
                <a href="https://api.whatsapp.com/send?phone=5514997077987" target="_blank">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z">
                        </path>
                    </svg>
                </a>
            </div>



        </div>
    @elseif ($etapa == 4)
        <div id="4"
            class="flex flex-col items-center justify-center h-full transition ease-out duration-700 transform opacity-100"
            wire:transition.scale.origin.top>
            <p class="text-2xl">Você já pagou uma parte!</p>
            <p class="mt-4">Lembre-se de pagar o valor total até dia 20/09</p>

            <div class="my-4 w-full rounded-lg px-2 py-2 md:ml-5 text-left">

                <p class="text-green-500 drop-shadow-md">Pago: R${{ $user->totalPagoEventoFormatado($evento) }}</p>
                <p class="font-bold text-red-500 drop-shadow-md">Falta:
                    R${{ $user->totalFaltaEventoFormatado($evento) }}
                </p>

                <div class="mb-4 h-2.5 w-full rounded-full bg-orange-300">
                    <div class="h-2.5 rounded-full bg-emerald-500"
                        style="width: {{ $user->totalPercentEvento($evento) }}%">
                    </div>
                </div>

                <div>
                    Pagamentos
                    <div class="max-h-48 overflow-auto rounded bg-gray-200 mt-1">
                        <ol class="relative ml-2 border-s border-gray-500">
                            @if ($user->pagamentoEvento($evento)->count() == 0)
                                <div class="text-center text-sm">
                                    <p>Nenhum pagamento realizado 😢</p>
                                    <p>Não perca sua vaga! Realize o pagamento</p>
                                    <p>🚌🥳</p>

                                    <a class="underline font-semibold text-lg text-blue-700"
                                        href="{{ route('evento', $evento) }}">Pagar</a>
                                </div>
                            @endif
                            @foreach ($user->pagamentoEvento($evento) as $pagamento)
                                <li class="mb-2 ms-4">
                                    <div
                                        class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-500">
                                    </div>
                                    <p class="mb-1 text-sm font-normal text-gray-400">
                                        {{ $pagamento->data_hora_formatado }}
                                    </p>
                                    <p class="text-sm font-normal text-gray-500">{{ $pagamento->meio_formatado }}</p>
                                    <h3 class="font-semibold text-green-800">R$ {{ $pagamento->valor_formatado }}</h3>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <button wire:click="pagarPix" class="p-4 mt-10 font-bold text-2xl rounded-md my-auto bg-[#00897B]">Pagar com
                PIX</button>
        </div>
    @elseif ($etapa == 5)
        <p class="text-2xl">Pagamento Confirmado!</p>
        <p class="mt-4">Parabéns! Sua viagem está completamente quitada. Agora é só aguardar e se preparar para essa
            experiência incrível. Estamos ansiosos para compartilhar esses momentos com você!</p>
        <p class="mt-4">Se precisar de mais alguma coisa, é só chamar o professor responsável!</p>
    @elseif ($etapa == 6)
        <div id="6"
            class="flex flex-col items-center justify-center h-full transition ease-out duration-700 transform opacity-100"
            wire:transition.scale.origin.top>
            <p class="text-2xl">As vagas acabaram!</p>

            <p class="mt-4">Não fique triste, você ainda pode ter chances de ir! Entre para a lista de espera e te
                avisaremos caso surja alguma vaga.</p>


            <button wire:click="aviseMe" class="mt-10 p-4 font-bold text-2xl rounded-md my-auto bg-[#00897B]">Avise-me!</button>
        </div>
    @elseif ($etapa == 7)
        <div id="7"
            class="flex flex-col items-center justify-center h-full transition ease-out duration-700 transform opacity-100"
            wire:transition.scale.origin.top>
            <p class="text-2xl">Você esta na lista de espera!</p>

            <p class="mt-4">Não fique triste, você ainda pode ter chances de ir!</p>
            <p class="mt-10">Avisaremos assim que uma vaga aparecer!</p>


        </div>
    @endif

</div>
