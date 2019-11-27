@extends('layouts.app')


@section('content')
        
    <div class="container">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Cadastro de Alunos</h1>
        </div>
        @include('layouts.statusMessages')
        <form method="post" id="form">
                @csrf
                <input type="hidden" name="id" value=@isset($aluno){{ $aluno->id }}@else "" @endif>
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
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" @if((isset($aluno) && $aluno->curso->id == $curso->id) || $curso->id == old('curso')) selected @endif>{{ $curso->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                
    
                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('aluno.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
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