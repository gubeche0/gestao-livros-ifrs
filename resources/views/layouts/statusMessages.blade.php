@if(session('erros'))
    @foreach (session('erros') as $erro)
    <div class="alert alert-danger" role="alert">
        {{ $erro }}
    </div>
    @endforeach
@endif

@if(session('success'))
    @foreach (session('success') as $succes)
    <div class="alert alert-success" role="alert">
        {{ $succes }}
    </div>
    @endforeach
@endif