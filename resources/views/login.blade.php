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

    <form action="{{ route('logar') }}" method="post">
        @csrf
        <input type="text" name="cpf">
        <input type="password" name="password">


        <button type="submit">entrar</button>

    </form>


</x-layout.layout-base>
