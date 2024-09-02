<div class="bg-white p-4">
    <div class="w-full">
        <div class="justify-around sm:flex">
            <div>
                <p><span class="font-bold">Evento: </span>{{ $evento->titulo_completo }}</p>
                <p><span class="font-bold">Data: </span>{{ $evento->dia_mes }} - {{ $evento->mes }}
                    ({{ $evento->dia_semana }})</p>
                <p><span class="font-bold">Disponíveis: </span>{{ $evento->vagas_disponiveis }}</p>
            </div>
            <div>
                <p><span class="font-bold">Pré Reserva: </span>{{ $evento->contagem_interessados }}</p>
                <p><span class="font-bold">Parciais: </span>{{ $evento->contagem_parciais }}</p>
            </div>
            <div>
                <p><span class="font-bold">Quitados: </span>{{ $evento->contagem_confirmados }}</p>
                <p><span class="font-bold">Espera: </span>{{ $evento->contagem_espera }}</p>
            </div>
        </div>

        <div class="border-blue-800 sm:p-4 lg:flex">
            <div class="lg:w-3/5">
                <form class="gap-2 sm:flex">
                    <div class="flex grow flex-col">
                        <label for="">Nome</label>
                        <input class="base-input" type="text" />
                    </div>
                    <div class="flex grow flex-col">
                        <label for="">CPF</label>
                        <input class="base-input" type="text" />
                    </div>
                    <div class="flex grow flex-col">
                        <label for="">Status</label>
                        <select class="base-input" name="" id="">
                            <option value="">Todos</option>
                            <option value="1">Quitados</option>
                            <option value="2">Parciais</option>
                            <option value="3">Pré Reserva</option>
                            <option value="4">Espera</option>
                        </select>
                    </div>
                </form>
                <table class="mt-6 w-full border-collapse border-x">
                    <thead class="">
                        <th class="text-start">Nome</th>
                        <th class="text-start">Status</th>
                        <th>Situação</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($evento->passageiros as $passageiro)
                            <tr class="odd:bg-gray-200">
                                <td>{{ $passageiro->user->nome_formatado }}</td>
                                <td class="">{{ $passageiro->status_formatado }}</td>
                                @switch($passageiro->status)
                                    @case(1)
                                        <td class="text-center">--</td>
                                    @break

                                    @case(2)
                                        <td class="text-center">R${{ $passageiro->total_pago }}</td>
                                    @break

                                    @case(3)
                                        <td class="text-center">--</td>
                                    @break

                                    @case(4)
                                        <td class="text-center">{{ $passageiro->ate_reserva_formatado }}</td>
                                    @break
                                @endswitch
                                <td class="cursor-pointer" >
                                    <a href="#dados" wire:click="selecionaPassageiro({{ $passageiro->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mx-auto size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="dados" class="sm:p-4 lg:w-2/5">
                @if ($passageiro_selecionado)
                    <div  class="rounded-lg bg-gray-600 p-4 text-white sticky top-0">
                        <div>
                            <div class="mb-2 text-center font-bold">{{ $passageiro_selecionado->user->nome_formatado }}
                            </div>
                            <div class="flex justify-between">
                                <div><span class="font-bold">Tipo:
                                    </span>{{ $passageiro_selecionado->user->tipo_formatado }}</div>
                                <div><span class="font-bold">CPF: </span>{{ $passageiro_selecionado->user->CPF }}</div>
                            </div>
                            <div class="flex justify-between">
                                <div><span class="font-bold">Celular:
                                    </span>{{ $passageiro_selecionado->user->celular }}</div>
                                <div><span class="font-bold">Nascimento:
                                    </span>{{ $passageiro_selecionado->user->nascimento }}</div>
                            </div>
                        </div>
                        <form class="" wire:submit.prevent="addPagamento">
                            <div class="gap-2 sm:flex">
                                <div class="flex flex-col">
                                    <label for="valor">Valor</label>
                                    <input name="valor" id="valor" wire:model="valor"
                                        class="base-input text-black" type="text" />
                                </div>
                                <div class="flex grow flex-col">
                                    <label for="tipo_pagamento">Tipo</label>
                                    <select wire:model="tipo_pagamento" class="base-input text-black"
                                        name="tipo_pagamento" id="tipo_pagamento">
                                        <option value="1">Dinheiro</option>
                                        <option value="2">PIX Conta</option>
                                        <option value="3">PIX Online</option>
                                    </select>
                                </div>
                            </div>
                            <div class="gap-2 sm:flex">
                                <div class="flex grow flex-col">
                                    <label for="data">Data</label>
                                    <input wire:model="data" name="data" id="data" class="base-input text-black"
                                        type="datetime-local" />
                                </div>
                                <div class="flex flex-col justify-end">
                                    <button type="submit" class="rounded-lg bg-green-500 p-2 font-bold">Salvar</button>
                                </div>
                            </div>
                        </form>
                        <div class="mt-6">
                            <div class="flex justify-around ">
                                <div><span class="font-bold">Pago:
                                    </span>R${{ $passageiro_selecionado->total_pago_desconto_formatado }}</div>
                                <div><span class="font-bold">Falta:
                                    </span>R${{ $passageiro_selecionado->total_falta_desconto_formatado }}</div>
                            </div>
                            <div class="mb-4 h-2.5 w-full rounded-full bg-orange-300 mt-2">
                                <div class="h-2.5 rounded-full bg-emerald-500"
                                    style="width: {{ $passageiro_selecionado->total_percent }}%">
                                </div>
                            </div>
                        </div>
                        <div class="max-h-48 overflow-auto rounded bg-gray-200 mt-1 text-black">
                            <ol class="relative ml-2 border-s border-gray-500">
                                @if ($passageiro_selecionado->pagamentos->count() == 0)
                                    <div class="text-center text-sm py-6">
                                        <p>Nenhum pagamento realizado 😢</p>

                                    </div>
                                @endif
                                @foreach ($passageiro_selecionado->pagamentos as $pagamento)
                                    <li class="mb-2 ms-4">
                                        <div
                                            class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-500">
                                        </div>
                                        <p class="mb-1 text-sm font-normal text-gray-400">
                                            {{ $pagamento->data_hora_formatado }}
                                        </p>
                                        <p class="text-sm font-normal text-gray-500">{{ $pagamento->meio_formatado }}
                                        </p>
                                        <h3 class="font-semibold text-green-800">R$ {{ $pagamento->valor_formatado }}
                                        </h3>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
