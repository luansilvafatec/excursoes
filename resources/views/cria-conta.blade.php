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
                                    <input required class="base-input sm:rounded-r-none" type="password" name="password_login"
                                        id="password_login" />
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
                        {{-- <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div> --}}
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
                                    <label class="cursor-pointer" for="tipo_2">Ex Aluno Fatec</label>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <input required @click="tipo = 3" class="cursor-pointer" type="radio"
                                        name="tipo" value="3" id="tipo_3" />
                                    <label class="cursor-pointer" for="tipo_3">Comunidade Externa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="just-validate-error-field just-validate-success-field">
                    <div class="grid w-full grid-cols-6 gap-2 text-cinza_cadastro">
                        <div class="col-span-6">
                            <label for="nome">Nome completo*</label>
                            <input name="nome" id="nome"
                                class="base-input"
                                type="text" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="nomesocial">Nome social</label>
                            <input name="nomesocial" id="nomesocial" class="base-input" type="text" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="nascimento">Nascimento*</label>
                            <input name="nascimento" id="nascimento" class="base-input" type="date" required min="1924-01-01" max="2010-12-31" />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="rg">RG*</label>
                            <input name="rg" id="rg" class="base-input" type="text" required />
                        </div>
                        <div class="col-span-6 xs:col-span-3">
                            <label for="cpf">CPF*</label>
                            <input name="cpf" id="cpf" class="base-input" type="text"
                                x-mask="999.999.999-99" required />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="email">E-mail*</label>
                            <input name="email" id="email" class="base-input" type="email" required
                                class="invalid:border-pink-500 invalid:text-pink-600
      focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2">
                            <label for="celular">Celular*</label>
                            <input name="celular" id="celular" class="base-input" type="text"
                                x-mask="(99)9 9999-9999" required />
                        </div>
                        <span class="col-span-3 sm:hidden"></span>
                        <div class="col-span-6 sm:col-span-4" x-show="tipo==1 || tipo==2">
                            <label class="" for="curso">Curso*</label>
                            <select class="base-input" name="curso" id="curso" required>
                                <option value="">Selecione</option>
                                <option value="1">Jogos Digitais</option>
                                <option value="2">ADS</option>
                                <option value="3">Seg. Info.</option>
                                <option value="4">Ciência de Dados</option>
                                <option value="5">Agronegócio</option>
                                <option value="6">AMS</option>
                                <option value="7">Gestão</option>
                            </select>
                        </div>
                        <div class="col-span-6 xs:col-span-3 sm:col-span-2" x-show="tipo == 1">
                            <label for="semestre">Semestre*</label>
                            <select class="base-input" name="semestre" id="semestre" required>
                                <option value="">Selecione</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <span class="col-span-3 sm:hidden" x-show="tipo == 1"></span>
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
        @vite('resources/js/cria-conya.js')

    </x-slot>

</x-layout.layout-base>
