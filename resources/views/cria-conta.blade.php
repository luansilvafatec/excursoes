<x-layout.layout-base>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div
        class="flex grow items-center justify-center bg-[url('https://tiinside.com.br/wp-content/uploads/2023/10/brasil-game-show-2022-e1696505407788.jpg')] bg-cover bg-center">

        <div class="xs:m-2 w-full max-w-5xl xs:rounded-2xl bg-white p-8 shadow-lg">
            <section>
                <div class="flex items-center justify-center">
                    <span class="grow border border-black"></span>
                    <h1 class="mx-4 text-center font-roboto text-xl leading-5 sm:text-2xl">Já tem cadastro? Faça login
                    </h1>
                    <span class="grow border border-black"></span>
                </div>
                <form id="formLogin"
                    class="mb-6 mt-3 flex flex-col items-center sm:flex-row sm:items-end"action="{{ route('logar') }}"
                    method="post" x-data="">
                    @csrf
                    <div class="w-full sm:flex">
                        <div class="flex grow flex-col sm:mr-2">
                            <label for="usuario" class="text-cinza_cadastro">CPF</label>
                            <input required class="base-input" type="text" name="cpf_login" id="cpf_login"
                                x-mask="999.999.999-99" />
                        </div>
                        <div class="flex grow flex-col">
                            <label for="senha" class="text-cinza_cadastro">Senha</label>
                            <div class="flex flex-col sm:flex-row items-center sm:items-start justify-center">
                                <div class="w-full">
                                    <input required class="base-input sm:rounded-r-none" type="password"
                                        name="password_login" id="password_login" />
                                </div>
                                <button
                                    class="mt-2 sm:mt-0 rounded-md border-none bg-[#7CB342] p-2 px-4 font-bold text-white hover:bg-[#7CB000] sm:rounded-l-none"
                                    type="submit">Entrar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </section>
            <section>
                <div class="flex items-center justify-center">
                    <span class="grow border border-black"></span>
                    <h1 class="mx-4 text-center font-roboto text-xl leading-5 sm:text-2xl">Não tem cadastro? Cadastre-se
                        para viajar</h1>
                    <span class="grow border border-black"></span>
                </div>
                <form class="mb-6 mt-3 flex flex-col items-center" x-data="{ tipo: 0 }" id="formCadastro"
                    action="{{ route('user.store') }}" method="post">
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
                                        name="tipo" value="1" id="tipo_1" />
                                    <label class="cursor-pointer" for="tipo_1">Aluno Fatec</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 2" class="cursor-pointer" type="radio"
                                        name="tipo" value="2" id="tipo_2" />
                                    <label class="cursor-pointer" for="tipo_2">Aluno ETEC</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 3" class="cursor-pointer" type="radio"
                                        name="tipo" value="3" id="tipo_3" />
                                    <label class="cursor-pointer" for="tipo_3">Ex Aluno Fatec</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 4" class="cursor-pointer" type="radio"
                                        name="tipo" value="4" id="tipo_4" />
                                    <label class="cursor-pointer" for="tipo_4">Ex Aluno ETEC</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 5" class="cursor-pointer" type="radio"
                                        name="tipo" value="5" id="tipo_5" />
                                    <label class="cursor-pointer" for="tipo_5">Comunidade Externa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="just-validate-error-field just-validate-success-field">
                    <div class="grid w-full grid-cols-6 gap-2 text-cinza_cadastro">
                        <div class="col-span-6">
                            <label for="nome">Nome completo*</label>
                            <input name="nome" id="nome" value="{{ old('nome') }}" class="base-input"
                                type="text" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="nomesocial">Nome social</label>
                            <input name="nomesocial" id="nomesocial" value="{{ old('nomesocial') }}"
                                class="base-input" type="text" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="nascimento">Nascimento*</label>
                            <input name="nascimento" id="nascimento" value="{{ old('nascimento') }}"
                                class="base-input" type="date" required min="1924-01-01" max="2010-12-31" />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="rg">RG*</label>
                            <input name="rg" id="rg" value="{{ old('rg') }}" class="base-input"
                                type="text" required />
                        </div>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="cpf">CPF*</label>
                            <input name="cpf" id="cpf" value="{{ old('cpf') }}" class="base-input"
                                type="text" x-mask="999.999.999-99" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="email">E-mail*</label>
                            <input name="email" id="email" value="{{ old('email') }}" class="base-input"
                                type="email" required
                                class="invalid:border-pink-500 invalid:text-pink-600
      focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="celular">Celular*</label>
                            <input name="celular" id="celular" value="{{ old('celular') }}" class="base-input"
                                type="text" x-mask="(99)9 9999-9999" required />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 sm:col-span-4" x-show="tipo != 5">
                            <label class="" for="curso">Curso*</label>
                            <select class="base-input" name="curso" value="{{ old('curso') }}" id="curso"
                                required>
                                <option value="">Selecione</option>
                                <option x-show="tipo==1 || tipo==3" value="1">Jogos Digitais</option>
                                <option x-show="tipo==1 || tipo==3" value="2">ADS</option>
                                <option x-show="tipo==1 || tipo==3" value="3">Seg. Info.</option>
                                <option x-show="tipo==1 || tipo==3" value="4">Ciência de Dados</option>
                                <option x-show="tipo==1 || tipo==3" value="5">Agronegócio</option>
                                <option x-show="tipo==1 || tipo==3" value="6">AMS</option>
                                <option x-show="tipo==1 || tipo==3" value="7">Gestão</option>
                                <option x-show="tipo==2 || tipo==4" value="8">Mtec Informática para internet</option>
                                <option x-show="tipo==2 || tipo==4" value="9">AMS</option>
                                <option x-show="tipo==2 || tipo==4" value="10">EMIF Ciências Humanas e Sociais</option>
                                <option x-show="tipo==2 || tipo==4" value="11">EMIF Linguagens e Suas Tecnologias</option>
                                <option x-show="tipo==2 || tipo==4" value="12">MTec Administração</option>
                                <option x-show="tipo==2 || tipo==4" value="13">Mtec Automação Industrial</option>
                                <option x-show="tipo==2 || tipo==4" value="14">Mtec-PI Edificações</option>
                                <option x-show="tipo==2 || tipo==4" value="15">Mtec Mecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="16">Mtec Meio Ambiente</option>
                                <option x-show="tipo==2 || tipo==4" value="17">Técnico em Administração</option>
                                <option x-show="tipo==2 || tipo==4" value="18">Técnico em Automação Industrial</option>
                                <option x-show="tipo==2 || tipo==4" value="19">Técnico em Canto</option>
                                <option x-show="tipo==2 || tipo==4" value="20">Técnico em desenvolvimento de Sistemas</option>
                                <option x-show="tipo==2 || tipo==4" value="21">Técnico em Edificações</option>
                                <option x-show="tipo==2 || tipo==4" value="22">Técnico em Eletrotécnica</option>
                                <option x-show="tipo==2 || tipo==4" value="23">Técnico em Eletromecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="24">Técnico em Enfermagem</option>
                                <option x-show="tipo==2 || tipo==4" value="25">Técnico em Informática para Internet</option>
                                <option x-show="tipo==2 || tipo==4" value="26">Técnico em Logística</option>
                                <option x-show="tipo==2 || tipo==4" value="27">Técnico em Mecânica</option>
                                <option x-show="tipo==2 || tipo==4" value="28">Técnico em Recursos Humanos</option>
                                <option x-show="tipo==2 || tipo==4" value="29">Técnico em Química</option>
                                <option x-show="tipo==2 || tipo==4" value="30">Técnico em Segurança do Trabalho</option>
                            </select>
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2" x-show="tipo < 3">
                            <label for="semestre">Semestre/Ano*</label>
                            <select class="base-input" name="semestre" id="semestre" value="{{ old('semestre') }}"
                                required>
                                <option value="">Selecione</option>
                                <option x-show="tipo==1" value="1">1 semestre</option>
                                <option x-show="tipo==1" value="2">2 semestre</option>
                                <option x-show="tipo==1" value="3">3 semestre</option>
                                <option x-show="tipo==1" value="4">4 semestre</option>
                                <option x-show="tipo==1" value="5">5 semestre</option>
                                <option x-show="tipo==1" value="6">6 semestre</option>
                                <option x-show="tipo==2" value="7">1 ano/semestre</option>
                                <option x-show="tipo==2" value="8">2 ano/semestre</option>
                                <option x-show="tipo==2" value="9">3 ano/semestre</option>
                            </select>
                        </div>
                        <span class="col-span-3 sm:hidden" x-show="tipo < 3"></span>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="password">Senha*</label>
                            <input name="password" id="password" class="base-input" type="password" required />
                        </div>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="confirmasenha">Confirmar senha*</label>
                            <input name="confirmasenha" id="confirmasenha" class="base-input" type="password"
                                required />
                        </div>
                    </div>
                    <button
                        class="mt-2 rounded-md border-none bg-[#7CB342] p-2 px-4 font-bold text-white hover:bg-[#7CB000]"
                        type="submit">Criar conta</button>
                </form>
            </section>
        </div>
    </div>

    <x-slot:script>
        @vite(['resources/js/cria-conta.js', 'resources/js/login.js'])

    </x-slot>

</x-layout.layout-base>
