<x-layout.layout-base>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div
        class="flex grow items-center justify-center bg-[url('https://tiinside.com.br/wp-content/uploads/2023/10/brasil-game-show-2022-e1696505407788.jpg')] bg-cover bg-center">

        <div class="xs:m-2 w-full max-w-5xl xs:rounded-2xl bg-white p-8 shadow-lg">
            <section>
                <div class="flex items-center justify-center">
                    <span class="grow border border-black"></span>
                    <h1 class="mx-4 text-center font-roboto text-xl leading-5 sm:text-2xl">Meus dados</h1>
                    <span class="grow border border-black"></span>
                </div>
                <form class="mb-6 mt-3 flex flex-col items-center" x-data="{ tipo: 0 }" id="formCadastro"
                    action="{{ route('user.update',$user) }}" method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="p-4 bg-red-100 text-red-700 font-bold w-full rounded-md border border-r-red-800">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- @dd($errors) --}}
                    @endif
                    <div class="grid w-full grid-cols-6 gap-2 text-cinza_cadastro">
                        <div class="w-full col-span-6" id="tipo">
                            <div class="col-span-6 items-center space-x-5 sm:flex leading-5">
                                <span>Como me classifico*:</span>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 1" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 1 ? 'checked' : '' }}
                                        value="1" id="tipo_1" />
                                    <label class="cursor-pointer" for="tipo_1">Aluno Fatec</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 2" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 2 ? 'checked' : '' }}
                                        value="2" id="tipo_2" />
                                    <label class="cursor-pointer" for="tipo_2">Aluno ETEC</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 3" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 3 ? 'checked' : '' }}
                                        value="3" id="tipo_3" />
                                    <label class="cursor-pointer" for="tipo_3">Ex Aluno Fatec/ETEC</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 4" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 4 ? 'checked' : '' }}
                                        value="4" id="tipo_4" />
                                    <label class="cursor-pointer" for="tipo_4">Comunidade Externa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="just-validate-error-field just-validate-success-field">
                    <div class="grid w-full grid-cols-6 gap-2 text-cinza_cadastro">
                        <div class="col-span-6">
                            <label for="nome">Nome completo*</label>
                            <input name="nome" id="nome" value="{{ old('nome', $user->nome) }}"
                                class="base-input" type="text" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="nomesocial">Nome social</label>
                            <input name="nomesocial" id="nomesocial" value="{{ old('nomesocial', $user->nomesocial) }}"
                                class="base-input" type="text" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="nascimento">Nascimento*</label>
                            <input name="nascimento" id="nascimento" value="{{ old('nascimento', $user->nascimento) }}"
                                class="base-input" type="date" required min="1924-01-01" max="2010-12-31" />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="rg">RG*</label>
                            <input name="rg" id="rg" value="{{ old('rg', $user->RG) }}" class="base-input"
                                type="text" required />
                        </div>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="cpf">CPF*</label>
                            <input disabled value="{{ old('cpf', $user->CPF) }}" class="base-input" type="text"
                                x-mask="999.999.999-99" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="email">E-mail*</label>
                            <input name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="base-input" type="email" required
                                class="invalid:border-pink-500 invalid:text-pink-600
      focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="celular">Celular*</label>
                            <input name="celular" id="celular" value="{{ old('celular', $user->celular) }}"
                                class="base-input" type="text" x-mask="(99)9 9999-9999" required />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 sm:col-span-4" x-show="tipo != 4">
                            <label class="" for="curso">Curso*</label>
                            <select class="base-input" name="curso" id="curso" required>
                                <option value="">Selecione</option>
                                <option value="1" {{ old('curso', $user->curso_id) == 1 ? 'selected' : '' }}>
                                    Jogos Digitais</option>
                                <option value="2" {{ old('curso', $user->curso_id) == 2 ? 'selected' : '' }}>ADS
                                </option>
                                <option value="3" {{ old('curso', $user->curso_id) == 3 ? 'selected' : '' }}>Seg.
                                    Info.</option>
                                <option value="4" {{ old('curso', $user->curso_id) == 4 ? 'selected' : '' }}>
                                    Ciência de Dados</option>
                                <option value="5" {{ old('curso', $user->curso_id) == 5 ? 'selected' : '' }}>
                                    Agronegócio</option>
                                <option value="6" {{ old('curso', $user->curso_id) == 6 ? 'selected' : '' }}>AMS
                                </option>
                                <option value="7" {{ old('curso', $user->curso_id) == 7 ? 'selected' : '' }}>
                                    Gestão</option>
                            </select>
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2" x-show="tipo == 1">
                            <label for="semestre">Semestre*</label>
                            <select class="base-input" name="semestre" id="semestre" required>
                                <option value="">Selecione</option>
                                <option value="1" {{ old('semestre', $user->semestre) == 1 ? 'selected' : '' }}>1
                                </option>
                                <option value="2" {{ old('semestre', $user->semestre) == 2 ? 'selected' : '' }}>2
                                </option>
                                <option value="3" {{ old('semestre', $user->semestre) == 3 ? 'selected' : '' }}>3
                                </option>
                                <option value="4" {{ old('semestre', $user->semestre) == 4 ? 'selected' : '' }}>4
                                </option>
                                <option value="5" {{ old('semestre', $user->semestre) == 5 ? 'selected' : '' }}>5
                                </option>
                                <option value="6" {{ old('semestre', $user->semestre) == 6 ? 'selected' : '' }}>6
                                </option>
                            </select>
                        </div>
                        <span class="col-span-3 sm:hidden" x-show="tipo == 1"></span>
                        <div class="border rounded-md grid grid-cols-subgrid col-span-6 p-4" x-data="{ alterasenha: false }">
                            <div class="col-span-6 flex items-center space-x-2">
                                <input @click="alterasenha = !alterasenha" x-bind:value="alterasenha" type="checkbox" name="alterasenha" id="alterasenha">
                                <label for="alterasenha">Alterar Senha</label>
                            </div>
                            <div class="col-span-6 xs:col-span-3" x-show="alterasenha">
                                <label for="password">Senha*</label>
                                <input name="password" id="password" class="base-input" type="password" required />
                            </div>
                            <div class="col-span-6 xs:col-span-3" x-show="alterasenha">
                                <label for="confirmasenha">Confirmar senha*</label>
                                <input name="confirmasenha" id="confirmasenha" class="base-input" type="password"
                                    required />
                            </div>
                        </div>
                    </div>
                    <button
                        class="mt-2 rounded-md border-none bg-[#7CB342] p-2 px-4 font-bold text-white hover:bg-[#7CB000]"
                        type="submit">Salvar</button>
                </form>
            </section>
        </div>
    </div>

    <x-slot:script>
        @vite('resources/js/cria-conta.js')

    </x-slot>

</x-layout.layout-base>
