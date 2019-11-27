@extends('layouts.app')    

@section('content')
        
<div class="container">
        <div class="panel-heading">
                <h1 class="panel-title text-center my-3">Cadastro de Assuntos</h1>
            </div>
        @include('layouts.statusMessages')
        <form method="post" id="form">
                @csrf
                <div class="form-group row">
    
                    <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
    
                        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" class="form-control" placeholder="Nome" required value='@isset($assunto){{ $assunto->nome }}@endif' autofocus>
                    </div>
                </div>
    
                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('assunto.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
                </div>
            </form>
</div>

@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validacao.js') }}"></script>    
@endsection