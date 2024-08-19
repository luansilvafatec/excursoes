<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet" />
    <title>{{ $title ?? 'Fatec Ourinhos - Excursões' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#DDE4E7]">
    <header class="items-center justify-between bg-[#C21D16] p-4">
        <div class="flex w-full justify-between border-b pb-1 text-white">
            <div class="mx-auto text-center leading-4 sm:m-0">Olá,
                {{ Auth()->user()->primeiro_nome ?? 'seja bem vindo(a)!' }}</div>
            <a href="mailto:luan@fatecourinhos.edu.br" class="hidden sm:flex">
                <svg class="mr-1 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg>
                <span>luan@fatecourinhos.edu.br</span>
            </a>
        </div>
        <div class="mt-2 flex items-center justify-between">
            <a href="{{route('home')}}">
            <img class="w-24" src="https://www.fatecourinhos.edu.br/static/cps/brand/fatec/logo-light.svg"
                alt="" /></a>
            @auth
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a class="flex font-bold text-white" href="#">
                        <div class="mr-1 -rotate-12 rounded-full border p-1">
                            <svg class="w-6 fill-current xs:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path
                                    d="M64 64C28.7 64 0 92.7 0 128l0 64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320l0 64c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6l0-64c0-35.3-28.7-64-64-64L64 64zm64 112l0 160c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-288 0c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32l320 0c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32l-320 0c-17.7 0-32-14.3-32-32l0-192z" />
                            </svg>
                        </div>
                        <span class="hidden xs:block">Quero viajar!</span>
                    </a>
                    <ul class="absolute right-0 top-full min-w-[150px] origin-top-right -translate-x-0 rounded-lg border border-slate-200 bg-white p-2 shadow-xl"
                        x-show="open" x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak
                        @focusout="await $nextTick();!$el.contains($focus.focused()) && (open = false)">
                        <li>
                            <a class="flex items-center p-2 text-slate-800 hover:bg-slate-50" href="#"> Meus dados
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-slate-800 hover:bg-slate-50" href="#"> Minhas
                                excursões </a>
                        </li>
                        <li>
                            <a class="flex items-center space-x-2 p-2 text-slate-800 hover:bg-slate-50" href="{{route('logout')}}">
                                <span>Sair</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <a class="flex font-bold text-white" href="{{route('login')}}">
                    <div class="mr-1 -rotate-12 rounded-full border p-1">
                        <svg class="w-6 fill-current xs:w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M64 64C28.7 64 0 92.7 0 128l0 64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320l0 64c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6l0-64c0-35.3-28.7-64-64-64L64 64zm64 112l0 160c0 8.8 7.2 16 16 16l288 0c8.8 0 16-7.2 16-16l0-160c0-8.8-7.2-16-16-16l-288 0c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32l320 0c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32l-320 0c-17.7 0-32-14.3-32-32l0-192z" />
                        </svg>
                    </div>
                    <span class="hidden xs:block">Quero viajar!</span>
                </a>
            @endauth

        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    @vite('resources/js/app.js')
    {{ $script ?? '' }}
</body>

</html>
