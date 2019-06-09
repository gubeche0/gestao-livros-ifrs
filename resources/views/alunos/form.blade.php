@extends('layouts.app')


@section('content')
        
    <div class="container">
            @include('layouts.statusMessages')
            <form method="post" id="form">
                    @csrf
                    <div class="form-group row">
                        <label for="matricula" class="col-sm-2 col-form-label">Matricula:</label>
                        <div class="col-sm-10">
        
                            <input type="number" name="matricula" id="matricula" class="form-control" placeholder="Matricula" required @isset($aluno) readonly @else autofocus @endif value=@isset($aluno){{ $aluno->matricula }}@else "" @endif>
                        </div>
                    </div>
            
                    <div class="form-group row">
        
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
        
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required @isset($aluno) autofocus @endif value='@isset($aluno){{ $aluno->nome }}@endif'>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" required value='@isset($aluno){{ $aluno->email }}@endif'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="curso" class="col-sm-2 col-form-label">Curso:</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="curso" id="curso">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>


    <script type="text/javascript" src="/res/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/res/js/additional-methods.min.js"></script>
    <script type="text/javascript" src="/res/js/localization/messages_pt_BR.js"></script>
    <script type="text/javascript" src="/res/js/validacao.js"></script>

    </body>

    </html>
@endsection