@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel-heading">
        <h1 class="panel-title text-center my-3">Registrar empréstimo</h1>
    </div>
    @include('layouts.statusMessages')
    <form method="post" id="form" onsubmit="return confirm()">
        @csrf
        <input type="hidden" id="forceSave" name="forceSave" value="false">
    
        <div class="form-row" id="emprestimo-row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="nome" class="col-sm-3 col-form-label">Código de barras:</label>
                    <div class="col-sm-9">
                        <input type="text" name="exemplar" id="exemplar" class="form-control" placeholder="Codigo de barras"
                                value="{{ old('exemplar')}}" autofocus>
                        <label id="exemplar-error" class="is-invalid text-danger" for="exemplar" style="display: none;">Este campo é requerido.</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="livro" class="col-sm-3 col-form-label">Turma:</label>
                    <div class="col-sm-9">
                        <select class="custom-select" name="turma" id="turma" required>
                            <option disabled selected>Selecione uma turma...</option>
                            @foreach ($turmas as $turma)
                                <option value="{{ $turma->id }}" data-curso="{{ $turma->curso->id }}" @if($turma->id == old('turma')) selected @endif>{{ $turma->nome }} - {{ $turma->ano }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="livro" class="col-sm-3 col-form-label">Aluno:</label>
                    <div class="col-sm-9">
                        <select class="custom-select" name="aluno" id="aluno" data-placeholder="Selecione um aluno">
        
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
                    <a href=" {{route('emprestimo.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
                </div>
            </div>
            <div style="width:25px"></div>
            <div id="borda" class="col-3" style="display: none; border: 1px solid #A9A9A9; padding:10px; border-radius:14px">
                <img id="fotoLivro" src="" class="img-thumbnail rounded mx-auto d-block" style="display: none; width:180px;">
                    <br>
                <span name="nomeLivro" id="nomeLivro"></span>
                    <br>
                <span name="volumeLivro" id="volumeLivro"></span>
                    <br>
                <span name="autorLivro" id="autorLivro"></span>
            </div>
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
        if($('#exemplar').val() != '') {
            consultarLivro();
        }
        @if(old('aluno') != '')
            $('#aluno').val({{ old('aluno')}});
            $('#aluno').trigger('chosen:updated');
        @endif
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
                $("#nomeLivro").html("<b>Nome do livro: </b>"+e.exemplar.livro.titulo);
                $("#volumeLivro").html("<b>Volume do livro: </b>"+e.exemplar.livro.volume);
                $("#autorLivro").html("<b>Autor do livro: </b>"+e.exemplar.livro.autor);
                $("#fotoLivro").val(e.exemplar.livro.urlFoto);
                $("#borda").show();
                
                if(e.emprestado == false){
                    livro = true;
                    $("#exemplar").removeClass("is-invalid");
                    $("#exemplar").addClass("is-valid");
                }else{
                    $("#exemplar-error").html("Livro já emprestado!");
                    $("#exemplar-error").show();
                    $("#exemplar").removeClass("is-valid");
                    $("#exemplar").addClass("is-invalid");
                    livro = false;
                    $('#exemplar').focus();
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
                $("#nomeLivro").text("");
                $("#volumeLivro").text("");
                $("#autorLivro").text("");
                $("#fotoLivro").hide().attr('src', "");
                $("#borda").hide();
            }
        });
    }

    function validar() {
        var valido = true;
        if ($('#turma').val()) {
            $("#turma").removeClass("is-invalid");
        } else {
            $("#turma").addClass("is-invalid");
            valido = false;
        }

        if (!livro) {
            $('#exemplar').focus();
            $("#exemplar").addClass("is-invalid");
            valido = false;
        } else {
            $("#exemplar").removeClass("is-invalid");
        }

        return valido;
    }

    function confirm(){
        if (!validar()) {
            return false;
        }
        
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
        
        return false;
    }

    function alertAlunoHasLivro() {
        Swal({
            title: 'Aluno já possui este livro!',
            text: 'Deseja continuar o emprestimo?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, continuar!',
            cancelButtonText: "Cancelar",
            focusCancel: false
        }).then((result) => {
            if (result.value) {
                $('#forceSave').val(true);
                $('#form').removeAttr('onsubmit').submit();
            }
        })
    }

    function atualizarAlunos()  {
        var cursoId = $('#turma').find(':selected').data('curso');
        var curso;
        if (!cursoId) {
            return;
        }
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

    @if(session('alunoHasLivro') == 'true')
    <script>
        alertAlunoHasLivro();
    </script>
    @endif
@endsection