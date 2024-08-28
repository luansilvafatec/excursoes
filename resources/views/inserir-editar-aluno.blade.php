<x-layout.layout-base>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div
        class="flex grow items-center justify-center bg-[url('https://tiinside.com.br/wp-content/uploads/2023/10/brasil-game-show-2022-e1696505407788.jpg')] bg-cover bg-center">

        <div class="xs:m-2 w-full max-w-5xl xs:rounded-2xl bg-white p-8 shadow-lg">
            <section>
                <div class="flex items-center justify-center">
                    <span class="grow border border-black"></span>
                    <h1 class="mx-4 text-center font-roboto text-xl leading-5 sm:text-2xl">Inserir/Editar Usuário</h1>
                    <span class="grow border border-black"></span>
                </div>
                <form class="mb-6 mt-3 flex flex-col items-center" x-data="{ tipo: {{$user->tipo??0}} }" id="formCadastro"
                    action="{{ route('salva-usuario', $cpf) }}" method="post">
                    @csrf
                    @if (session()->has('sucesso'))
                        <div class="p-4 bg-green-100 text-green-700 font-bold w-full rounded-md border border-r-green-800">
                            {{ session()->get('sucesso') }}
                        </div>
                    @endif
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
                                    <label class="cursor-pointer" for="tipo_3">Ex Aluno Fatec</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 4" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 4 ? 'checked' : '' }}
                                        value="4" id="tipo_4" />
                                    <label class="cursor-pointer" for="tipo_4">Ex Aluno ETEC</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 5" class="cursor-pointer" type="radio"
                                        name="tipo" {{ old('tipo', $user->tipo) == 5 ? 'checked' : '' }}
                                        value="5" id="tipo_5" />
                                    <label class="cursor-pointer" for="tipo_5">Comunidade Externa</label>
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
                            <input value="{{ old('cpf', $user->CPF) }}" name="cpf" id="cpf" class="base-input" type="text"
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
                        <div class="col-span-6 sm:col-span-4" x-show="tipo != 5">
                            <label class="" for="curso">Curso*</label>
                            <select class="base-input" name="curso" id="curso" required>
                                <option value="">Selecione</option>
                                <option x-show="tipo==1 || tipo==3" value="1" {{ old('curso', $user->curso_id) == 1 ? 'selected' : '' }}>Jogos Digitais</option>
                                <option x-show="tipo==1 || tipo==3" value="2" {{ old('curso', $user->curso_id) == 2 ? 'selected' : '' }}>ADS</option>
                                <option x-show="tipo==1 || tipo==3" value="3" {{ old('curso', $user->curso_id) == 3 ? 'selected' : '' }}>Seg. Info.</option>
                                <option x-show="tipo==1 || tipo==3" value="4" {{ old('curso', $user->curso_id) == 4 ? 'selected' : '' }}>Ciência de Dados</option>
                                <option x-show="tipo==1 || tipo==3" value="5" {{ old('curso', $user->curso_id) == 5 ? 'selected' : '' }}>Agronegócio</option>
                                <option x-show="tipo==1 || tipo==3" value="6" {{ old('curso', $user->curso_id) == 6 ? 'selected' : '' }}>AMS</option>
                                <option x-show="tipo==1 || tipo==3" value="7" {{ old('curso', $user->curso_id) == 7 ? 'selected' : '' }}>Gestão</option>
                                <option x-show="tipo==2 || tipo==4" value="8" {{ old('curso', $user->curso_id) == 8 ? 'selected' : '' }}>Mtec Informática para internet</option>
                                <option x-show="tipo==2 || tipo==4" value="9" {{ old('curso', $user->curso_id) == 9 ? 'selected' : '' }}>AMS</option>
                                <option x-show="tipo==2 || tipo==4" value="10" {{ old('curso', $user->curso_id) == 10 ? 'selected' : '' }}>EMIF Ciências Humanas e Sociais</option>
                                <option x-show="tipo==2 || tipo==4" value="11" {{ old('curso', $user->curso_id) == 11 ? 'selected' : '' }}>EMIF Linguagens e Suas Tecnologias</option>
                                <option x-show="tipo==2 || tipo==4" value="12" {{ old('curso', $user->curso_id) == 12 ? 'selected' : '' }}>MTec Administração</option>
                                <option x-show="tipo==2 || tipo==4" value="13" {{ old('curso', $user->curso_id) == 13 ? 'selected' : '' }}>Mtec Automação Industrial</option>
                                <option x-show="tipo==2 || tipo==4" value="14" {{ old('curso', $user->curso_id) == 14 ? 'selected' : '' }}>Mtec-PI Edificações</option>
                                <option x-show="tipo==2 || tipo==4" value="15" {{ old('curso', $user->curso_id) == 15 ? 'selected' : '' }}>Mtec Mecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="16" {{ old('curso', $user->curso_id) == 16 ? 'selected' : '' }}>Mtec Meio Ambiente</option>
                                <option x-show="tipo==2 || tipo==4" value="17" {{ old('curso', $user->curso_id) == 17 ? 'selected' : '' }}>Técnico em Administração</option>
                                <option x-show="tipo==2 || tipo==4" value="18" {{ old('curso', $user->curso_id) == 18 ? 'selected' : '' }}>Técnico em Automação Industrial</option>
                                <option x-show="tipo==2 || tipo==4" value="19" {{ old('curso', $user->curso_id) == 19 ? 'selected' : '' }}>Técnico em Canto</option>
                                <option x-show="tipo==2 || tipo==4" value="20" {{ old('curso', $user->curso_id) == 20 ? 'selected' : '' }}>Técnico em desenvolvimento de Sistemas</option>
                                <option x-show="tipo==2 || tipo==4" value="21" {{ old('curso', $user->curso_id) == 21 ? 'selected' : '' }}>Técnico em Edificações</option>
                                <option x-show="tipo==2 || tipo==4" value="22" {{ old('curso', $user->curso_id) == 22 ? 'selected' : '' }}>Técnico em Eletrotécnica</option>
                                <option x-show="tipo==2 || tipo==4" value="23" {{ old('curso', $user->curso_id) == 23 ? 'selected' : '' }}>Técnico em Eletromecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="24" {{ old('curso', $user->curso_id) == 24 ? 'selected' : '' }}>Técnico em Enfermagem</option>
                                <option x-show="tipo==2 || tipo==4" value="25" {{ old('curso', $user->curso_id) == 25 ? 'selected' : '' }}>Técnico em Informática para Internet</option>
                                <option x-show="tipo==2 || tipo==4" value="26" {{ old('curso', $user->curso_id) == 26 ? 'selected' : '' }}>Técnico em Logística</option>
                                <option x-show="tipo==2 || tipo==4" value="27" {{ old('curso', $user->curso_id) == 27 ? 'selected' : '' }}>Técnico em Mecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="28" {{ old('curso', $user->curso_id) == 28 ? 'selected' : '' }}>Técnico em Recursos Humanos</option>
                                <option x-show="tipo==2 || tipo==4" value="29" {{ old('curso', $user->curso_id) == 29 ? 'selected' : '' }}>Técnico em Química</option>
                                <option x-show="tipo==2 || tipo==4" value="30" {{ old('curso', $user->curso_id) == 30 ? 'selected' : '' }}>Técnico em Segurança do Trabalho</option>
                            </select>
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2" x-show="tipo < 3">
                            <label for="semestre">Semestre/ano*</label>
                            <select class="base-input" name="semestre" id="semestre" required>
                                <option value="">Selecione</option>
                                <option x-show="tipo==1" value="1" {{ old('semestre', $user->semestre) == 1 ? 'selected' : '' }}>1 Semestre</option>
                                <option x-show="tipo==1" value="2" {{ old('semestre', $user->semestre) == 2 ? 'selected' : '' }}>2 Semestre</option>
                                <option x-show="tipo==1" value="3" {{ old('semestre', $user->semestre) == 3 ? 'selected' : '' }}>3 Semestre</option>
                                <option x-show="tipo==1" value="4" {{ old('semestre', $user->semestre) == 4 ? 'selected' : '' }}>4 Semestre</option>
                                <option x-show="tipo==1" value="5" {{ old('semestre', $user->semestre) == 5 ? 'selected' : '' }}>5 Semestre</option>
                                <option x-show="tipo==1" value="6" {{ old('semestre', $user->semestre) == 6 ? 'selected' : '' }}>6 Semestre</option>
                                <option x-show="tipo==2" value="7" {{ old('semestre', $user->semestre) == 7 ? 'selected' : '' }}>1 Semestre/ano</option>
                                <option x-show="tipo==2" value="8" {{ old('semestre', $user->semestre) == 8 ? 'selected' : '' }}>2 Semestre/ano</option>
                                <option x-show="tipo==2" value="9" {{ old('semestre', $user->semestre) == 9 ? 'selected' : '' }}>3 Semestre/ano</option>
                            </select>
                        </div>
                        <span class="col-span-3 sm:hidden" x-show="tipo < 3"></span>
                        <div class="border rounded-md grid grid-cols-subgrid col-span-6 p-4" x-data="{ alterasenha: false }">
                            <div class="col-span-6 flex items-center space-x-2">
                                <input @click="alterasenha = !alterasenha" x-bind:value="alterasenha"
                                    type="checkbox" name="alterasenha" id="alterasenha">
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
