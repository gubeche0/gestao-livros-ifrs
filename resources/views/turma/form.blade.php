@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    <form method="post" enctype="multipart/form-data" id="form">
            @csrf
            <div class="form-group row">

                <label for="isbn" class="col-sm-2 col-form-label">Descrição:</label>
                <div class="col-sm-10">

                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Descrição" required value='@isset($turma){{ $turma->nome }}@endif' autofocus>
                </div>
            </div> 
            
            <div class="form-group row">
                <label for="curso" class="col-sm-2 col-form-label">Curso:</label>
                <div class="col-sm-10">
                    <select class="custom-select @error('curso') is-invalid @enderror" name="curso" id="curso" @if(isset($turma)) disabled @endif>
                        {loop="$cursos"}
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" @if(isset($turma) && $turma->curso->id == $curso->id) selected @endif>{{ $curso->nome }}</option>
                        @endforeach
                        {/loop}
                    </select>
                </div>
            </div>

            <div class="form-group row">

                <label for="volume" class="col-sm-2 col-form-label">Ano de vigência:</label>
                <div class="col-sm-10">

                    <input type="number" name="ano" id="ano" class="form-control" placeholder="Ano" required value='@isset($ano){{ $ano }}@endif' disabled>
                </div>
            </div> 

            <div class="form-group row">
                <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                <a href=" {{route('turma.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
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