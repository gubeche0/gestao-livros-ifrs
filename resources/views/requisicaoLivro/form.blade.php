@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    <form method="post" enctype="multipart/form-data" id="form">
            @csrf            
            <div class="form-group row">

                <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
                <div class="col-sm-10">

                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" required autofocus>
                </div>
            </div> 

            <div class="form-group row">

                <label for="volume" class="col-sm-2 col-form-label">Volume:</label>
                <div class="col-sm-10">

                    <input type="text" name="volume" id="volume" class="form-control" placeholder="Volume">
                </div>
            </div> 

            <div class="form-group row">

                <label for="autor" class="col-sm-2 col-form-label">Autor:</label>
                <div class="col-sm-10">

                    <input type="text" name="autor" id="autor" class="form-control" placeholder="Autor">
                </div>
            </div>

            <div class="form-group row">
                <label for="area" class="col-sm-2 col-form-label">Área de conhecimento:</label>
                <div class="col-sm-10">
                    <select class="custom-select @error('area') is-invalid @enderror" name="area" id="area">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" @if((isset($livro) && $livro->area->id == $area->id) || $area->id == old('area')) selected @endif>{{ $area->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="assunto" class="col-sm-2 col-form-label">Assunto:</label>
                <div class="col-sm-10">
                    <select class="custom-select @error('assunto') is-invalid @enderror" name="assunto" id="assunto">
                        @foreach ($assuntos as $assunto)
                            <option value="{{ $assunto->id }}" @if((isset($livro) && $livro->assunto->id == $assunto->id) || $assunto->id == old('assunto')) selected @endif>{{ $assunto->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                

            <div class="form-group row">
                <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                <a href="@if(auth()->user()->isTipo(App\User::PROFESSOR)){{ route('home')}} @else {{route('requisicaoLivro.index')}} @endif " class="btn btn-danger col ml-1" > Cancelar </a>
            </div>

        </form>

</div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
<script>
$(document).ready(function (){
    $("#form").validate({
        errorClass: "is-invalid text-danger",
        validClass: "is-valid",
        label: "h2",
        rules: {
            titulo:{
                required:true
            }
        },
    })
});


</script>
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>

<script>
    
</script>
@endsection