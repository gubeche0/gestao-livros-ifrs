@extends('layouts.app')
@section('content')

<div class="container">
    @include('layouts.statusMessages')
    <form method="post" id="form" onsubmit="return confirm()">
        @csrf
        <div class="form-row" id="livro-row">
            <div class="col">
                <div class="form-group row">

                    <label for="nome" class="col-sm-2 col-form-label">Codigo de barras:</label>
                    <div class="col-sm-10">
                        <input type="text" name="exemplar" id="exemplar" class="form-control" placeholder="Codigo de barras"
                             value="" autofocus>
                        <label id="exemplar-error" class="is-invalid text-danger" for="exemplar" style="display: none;">Este campo é requerido.</label>
                    </div>
                </div>

                <div class="form-group row">

                    <label for="titulo" class="col-sm-2 col-form-label">Nome do livro:</label>
                    <div class="col-sm-10">

                        <input type="text" name="nomeLivro" id="nomeLivro" class="form-control" placeholder="Nome do Livro"
                            disabled value="">
                    </div>
                </div>
                <div class="form-group row">

                    <label for="nome" class="col-sm-2 col-form-label">Volume do livro:</label>
                    <div class="col-sm-10">

                        <input type="text" name="volumeLivro" id="volumeLivro" class="form-control" placeholder="Volume do Livro"
                            disabled value="">
                    </div>
                </div>
                <div class="form-group row">

                    <label for="nome" class="col-sm-2 col-form-label">Autor do livro:</label>
                    <div class="col-sm-10">

                        <input type="text" name="autorLivro" id="autorLivro" class="form-control" placeholder="Autor do Livro"
                            disabled>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img id="fotoLivro" src="" class="img-thumbnail" style="display: none">
            </div>
        </div>

        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Turma:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="turma" id="turma" required>
                    <option disabled selected>Selecione uma turma...</option>
                    @foreach ($turmas as $turma)
                        <option value="{{ $turma->id }}" data-curso="{{ $turma->curso->id }}" @if($turma->id == old('turma')) selected @endif>{{ $turma->nome }} - {{ $turma->ano }}</option>
                    @endforeach
                    
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Aluno:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="aluno" id="aluno" data-placeholder="Selecione um aluno">

                    {{-- @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->nome }} - {{ $aluno->matricula }}</option>
                    @endforeach --}}
                    
                </select>
            </div>
        </div>

        <div class="form-group row">
            <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
            <a href=" {{route('emprestimo.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
        </div>

    </form>

</div>

@endsection

@section('js')
<script src="{{ asset('js/chosen.jquery.min.js')}}"></script>
<script>
    var livro = false;
    var cursos = <?php echo $cursos->toJson(); ?>;

    $(document).ready(function () {
        $("#aluno").chosen();
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                if($('#exemplar').is(':focus')) {
                    consultarLivro();
                    event.preventDefault();
                    return false;
                }
            }
        });

        $('#turma').change(function() {
            atualizarAlunos();
        });

        $("#exemplar").change(function () {
            consultarLivro();
        });
        atualizarAlunos();
    });

    function consultarLivro(){
        var code = $('#exemplar').val();
        if(!code){
            code = 0;
        }
        $.ajax({
            method: "GET",
            url: "/api/exemplar/" + code,
            dataType: "json",
        }).done(function (e) {
            console.log(e);
            if (e.status) {
                $("#exemplar-error").hide();
                $("#nomeLivro").val(e.exemplar.livro.titulo);
                $("#volumeLivro").val(e.exemplar.livro.volume);
                $("#autorLivro").val(e.exemplar.livro.autor);
                $("#fotoLivro").val(e.exemplar.livro.urlFoto);
                
                if(e.emprestado == false){
                    livro = true;
                    $("#exemplar").removeClass("is-invalid");
                    $("#exemplar").addClass("is-valid");
                    $('#exemplar').focus();
                }else{
                    $("#exemplar-error").html("Livro já emprestado!");
                    $("#exemplar-error").show();
                    $("#exemplar").removeClass("is-valid");
                    $("#exemplar").addClass("is-invalid");
                    livro = false;
                }
                
                if (e.exemplar.livro.urlFoto) {
                    $("#fotoLivro").show().attr('src', '/storage/fotoLivro/' + e.exemplar.livro.urlFoto);
                } else {
                    $("#fotoLivro").hide().attr('src', "");
                }
            } else {
                livro = false;
                $('#exemplar').focus();
                $("#exemplar-error").html("Livro Não cadastrado!");
                $("#exemplar-error").show();
                $("#exemplar").removeClass("is-valid");
                $("#exemplar").addClass("is-invalid");
                $("#nomeLivro").val("");
                $("#volumeLivro").val("");
                $("#autorLivro").val("");
                $("#fotoLivro").hide().attr('src', "");
            }
        });
    }


    function confirm(){
        
        if(livro) {
            Swal({
                title: 'Deseja registrar o emprestimo?',
                // text: 'Não é possivel reverter isso',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, registrar!',
                cancelButtonText: "Cancelar",
                focusCancel: false
            }).then((result) => {
                if (result.value) {
                    $('#form').removeAttr('onsubmit').submit();
                }

            })
            
        } else {
            $('#exemplar').focus();
        }
        
        return false;
    }

    function atualizarAlunos()  {
        var cursoId = $('#turma').find(':selected').data('curso');
        var curso;
        cursos.forEach(function(value, index) {
            if(value.id == cursoId) {
                curso = value;
                return;
            }
        });

        $('#aluno').html('');
        curso.alunos.forEach(function(value, index) {
            $('#aluno').append(
                $('<option>', {value: value.id, text: value.nome + ' - ' + value.matricula})
            );
        });
        $('#aluno').trigger('chosen:updated');

    }

</script>
@endsection