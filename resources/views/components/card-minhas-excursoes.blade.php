<div class="relative w-full max-w-3xl rounded-lg bg-[#688590] px-4 md:flex lg:items-center">
    <div class="flex flex-col items-center sm:items-start sm:flex-row lg:-ml-10">
        <img class="-mt-4 aspect-square w-72 rounded-lg object-cover"
            src="{{$evento->foto_card}}" alt=""
            srcset="" />
        <div>
            <div
                class="-mt-2 rounded-b-lg flex space-x-1 items-center justify-center w-full sm:w-auto bg-[#EF6C00] py-2 text-center font-bold text-white sm:m-0 sm:rounded-none sm:rounded-ee-2xl lg:px-10">
                <span>{{ $user->statusEvento($evento)[0] }}</span>
                <div class="relative" x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                    </a>
                    <div class="absolute text-xs font-light text-gray-600 z-50 right-0 top-full min-w-[150px] origin-top-right -translate-x-0 rounded-es-lg border border-slate-200 bg-white p-2 shadow-xl"
                        x-show="tooltip" x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak
                        @focusout="await $nextTick();!$el.contains($focus.focused()) && (open = false)">
                        {{ $user->statusEvento($evento)[1] }}
                    </div>

                </div>
            </div>
            <div class="px-4 pt-2 text-white text-lg font-semibold">
                <p>Excursão: {{ $evento->titulo }}</p>
                <p>Data: {{ $evento->dia_mes }} de {{ $evento->mes }}</p>
                <p>Saída: {{ $evento->saida_fatec_formatada }}</p>
                <p>Valor: R${{ $evento->valor_formatado }}</p>
                <a class="font-light underline" href="{{route('evento', $evento)}}">+ Detalhes</a>
            </div>
        </div>
    </div>
    <div class="my-4 grow rounded-lg bg-white bg-opacity-30 px-2 py-2 md:ml-5">
        <p class="text-green-700 drop-shadow-md">Pago: R${{ $user->totalPagoEventoFormatado($evento) }}</p>
        <p class="font-bold text-red-700 drop-shadow-md">Falta: R${{ $user->totalFaltaEventoFormatado($evento) }}</p>

        <div class="mb-4 h-2.5 w-full rounded-full bg-orange-300">
            <div class="h-2.5 rounded-full bg-emerald-600" style="width: {{ $user->totalPercentEvento($evento) }}%">
            </div>
        </div>

        <div>
            Pagamentos
            <div class="max-h-48 overflow-auto rounded bg-gray-200 mt-1">
                <ol class="relative ml-2 border-s border-gray-500">
                    @foreach ($user->pagamentoEvento($evento) as $pagamento)
                        <li class="mb-2 ms-4">
                            <div
                                class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-500">
                            </div>
                            <p class="mb-1 text-sm font-normal text-gray-400">{{$pagamento->data_hora_formatado}}</p>
                            <p class="text-sm font-normal text-gray-500">{{$pagamento->meio_formatado}}</p>
                            <h3 class="font-semibold text-green-800">R$ {{$pagamento->valor_formatado}}</h3>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
