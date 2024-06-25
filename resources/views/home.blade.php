<x-layout.layout-base>
    <a href="{{route('login')}}">Login</a>

    @foreach ($eventos as $evento)
        {{$evento->titulo}}
    @endforeach


</x-layout.layout-base>
