@extends('layouts.app')


@section('content')
        
    <div class="container">
            @include('layouts.statusMessages')
            <form method="post" id="form">
                    @csrf
                    <div class="form-group row">
                        <label for="matricula" class="col-sm-2 col-form-label">Matricula:</label>
                        <div class="col-sm-10">
        
                            <input type="number" name="matricula" id="matricula" class="form-control @error('matricula') is-invalid @enderror" placeholder="Matricula" required @isset($aluno) readonly @else autofocus @endif value=@isset($aluno){{ $aluno->matricula }}@else "" @endif>
                        </div>
                    </div>
            
                    <div class="form-group row">
        
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
        
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome" required @isset($aluno) autofocus @endif value='@isset($aluno){{ $aluno->nome }}@endif'>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required value='@isset($aluno){{ $aluno->email }}@endif'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="curso" class="col-sm-2 col-form-label">Curso:</label>
                        <div class="col-sm-10">
                            <select class="custom-select @error('curso') is-invalid @enderror" name="curso" id="curso">
                                {loop="$cursos"}
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}" @if(isset($aluno) && $aluno->curso->id == $curso->id) selected @endif>{{ $curso->nome }}</option>
                                @endforeach
                                {/loop}
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
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/localization/messages_pt_BR.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validacao.js') }}"></script>
@endsection