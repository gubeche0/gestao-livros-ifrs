@extends('layouts.app')    

@section('content')
        
<div class="container">
        @include('layouts.statusMessages')
        <form method="post" id="form">
                @csrf
                <div class="form-group row">
    
                    <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
    
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required value='@isset($curso){{ $curso->nome }}@endif' autofocus>
                    </div>
                </div>
                <div class="form-group row">
    
                    <label for="abreviacao" class="col-sm-2 col-form-label">Abreviacao:</label>
                    <div class="col-sm-10">
    
                        <input type="text" name="abreviacao" id="abreviacao" class="form-control" placeholder="Abreviacao" required value='@isset($curso){{ $curso->abreviacao }}@endif'>
                    </div>
                </div>
    
                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('curso.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
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