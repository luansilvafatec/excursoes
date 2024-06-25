<x-layout.layout-base>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="flex flex-col p-10" action="{{ route('user.store') }}" method="post">
        @csrf
        <label for="">tipo:</label>
        <input class="border" type="text" name="tipo" >
        <label for="">nome:</label>
        <input class="border" type="text" name="nome" >
        <label for="">nomesocial:</label>
        <input class="border" type="text" name="nomesocial" >
        <label for="">rg:</label>
        <input class="border" type="text" name="rg" >
        <label for="">nascimento:</label>
        <input class="border" type="text" name="nascimento" >
        <label for="">celular:</label>
        <input class="border" type="text" name="celular" >
        <label for="">email:</label>
        <input class="border" type="text" name="email" >
        <label for="">curso:</label>
        <input class="border" type="text" name="curso" >
        <label for="">semestre:</label>
        <input class="border" type="text" name="semestre" >
        <label for="">matricula:</label>
        <input class="border" type="text" name="matricula" >
        <label for="">cpf:</label>
        <input class="border" x-data  x-mask="999.999.999-99" type="text" name="cpf" placeholder="123.456.789-00">
        <label for="">password:</label>
        <input class="border" type="password" name="password">


        <button type="submit">entrar</button>

    </form>


</x-layout.layout-base>
