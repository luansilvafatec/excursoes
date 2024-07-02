<x-layout.layout-base>
    {{-- <a href="{{route('login')}}">Login</a>

    @foreach ($eventos as $evento)
        {{$evento->titulo}}
    @endforeach --}}

    <link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet" />

<div class="min-h-screen bg-[#DDE4E7]">
  <div class="flex items-center justify-between bg-[#C21D16] p-4">
    <div class="flex flex-col">
      <img class="w-24" src="https://www.fatecourinhos.edu.br/static/cps/brand/fatec/logo-light.svg" alt="" />
    </div>
    <div class="rounded-md bg-[#4D6269] p-2">
      <a class="font-bold text-white shadow-lg">Entrar</a>
    </div>
  </div>

  <div class="flex flex-col items-center justify-center p-10">
    <div class="font-roboto text-2xl font-bold text-gray-800">Explore, Aprenda e Divirta-se!</div>

    <div class="mt-4 max-w-[40rem] text-center text-gray-700">Participe de Excursões Cheias de Conhecimento e Entretenimento: Melhore suas Habilidades e Aproveite Cada Momento.</div>
  </div>

  <div>
    <div class="flex items-center justify-center px-8">
      <div class="grow border border-gray-500"></div>
      <div class="mx-4 text-center font-roboto text-2xl">Excursões em Andamento</div>
      <div class="grow border border-gray-500"></div>
    </div>

    <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 md:grid-cols-3">
      <div class="card">
        <img class="rounded-t-lg" src="https://www.tnh1.com.br/fileadmin/_processed_/d/9/csm_CCXP_tera_2a_edicao_totalmente_virtual_com_promessa_de_50_horas_de_conteudo_Divulgacao_7a46703637.jpg" alt="" />
        <div class="p-4">
          <div class="my-4 font-roboto text-xl">
            CCXP
          </div>
          <div class="text-gray-800">
            Mergulhe no maior evento de cultura pop do mundo! Conheça artistas, assista a painéis exclusivos, explore os estandes das maiores franquias e viva a experiência completa da CCXP
          </div>
        </div>
        <div class="btn-primary-base bg-slate-300">em breve</div>
      </div>

    </div>
  </div>
</div>



</x-layout.layout-base>
