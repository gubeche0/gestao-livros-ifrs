@isset($erros)
    @foreach ($erros as $erro)
    <div class="alert alert-danger" role="alert">
        {{ $erro }}
    </div>
    @endforeach
@endisset

@isset($success)
    @foreach ($success as $succes)
    <div class="alert alert-success" role="alert">
        {{ $succes }}
    </div>
    @endforeach
@endisset