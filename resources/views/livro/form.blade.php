@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    <form method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group row">

                <label for="isbn" class="col-sm-2 col-form-label">ISBN:</label>
                <div class="col-sm-10">

                    <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN" required value='@isset($livro){{ $livro->isbn }}@endif' @if(isset($livro)) readonly @else autofocus @endif>
                </div>
            </div> 
            
            <div class="form-group row">

                <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
                <div class="col-sm-10">

                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo" required value='@isset($livro){{ $livro->titulo }}@endif' @if(!isset($livro)) autofocus @endif>
                </div>
            </div> 

            <div class="form-group row">

                <label for="volume" class="col-sm-2 col-form-label">Volume:</label>
                <div class="col-sm-10">

                    <input type="text" name="volume" id="volume" class="form-control" placeholder="Volume" required value='@isset($livro){{ $livro->volume }}@endif'>
                </div>
            </div> 

            <div class="form-group row">

                <label for="autor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">

                    <input type="text" name="autor" id="autor" class="form-control" placeholder="autor" required value='@isset($livro){{ $livro->autor }}@endif'>
                </div>
            </div>

            <div class="form-group row">

                <label for="foto" class="col-sm-2 col-form-label">Foto do livro:</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto" >
                        <label class="custom-file-label" for="foto">Escolher arquivo</label>
                      </div>
                    
                </div>
            </div>

            <div class="form-group row">
                <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                <input name="cancelar" id="cancelar" class="btn btn-danger col ml-1" type="reset" value="Cancelar">
            </div>

            


        </form>

</div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validacao.js') }}"></script>
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
@endsection