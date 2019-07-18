@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    <form method="post">
        @csrf
        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Livro:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="livro" id="livro">
                    
                    @foreach ($livros as $livro)
                    <option value="{{ $livro->id }}" @if(isset($exemplar) && $exemplar->livro->id == $livro->id) selected @endif >{{ $livro->titulo}}</option> 
                    @endforeach
                    
                </select> 
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

@endsection