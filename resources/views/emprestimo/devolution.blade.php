@extends('layouts.app')
@section('content')
<div class="container">
    <div class="panel-heading">
        <h1 class="panel-title text-center my-3">Registrar devolução</h1>
    </div>
    @include('layouts.statusMessages')
    <form method="post" id="form" onsubmit="return confirm()">
        @csrf
        <input type="hidden" id="idEmprestimo" name="idEmprestimo">
        <input type="hidden" id="idExemplar" name="idExemplar">
        
        <div class="form-row" id="livro-row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Código de barras:</label>
                    <div class="col-sm-10">
                        <input type="text" name="exemplar" id="exemplar" class="form-control" placeholder="Codigo de barras"
                            value="" autofocus>
                        <label id="exemplar-error" class="is-invalid text-danger" for="exemplar" style="display: none;">Este
                            campo é requerido.</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Status do livro:</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="statusLivro" name="statusLivro" checked>
                            <label class="custom-control-label" for="statusLivro">Utilizavel</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center" style="margin-bottom:10px">
                    <div id="borda1" class="col-10 " style="display:none; border: 1px solid #A9A9A9; padding:10px; border-radius:14px; ">
                        <div class="row">
                                <div class="col-4">
                                    <img id="fotoLivro" src="" class="img-thumbnail rounded mx-auto d-block" style="display: none; width:180px;">
                                </div>
                                <div class="col-8">
                                    <b><h5 class="text-center">Livro</h5></b>
                                    <span name="nomeLivro" id="nomeLivro"></span>
                                        <br>
                                    <span name="volumeLivro" id="volumeLivro"></span>
                                        <br>
                                    <span name="autorLivro" id="autorLivro"></span>
                                        <br>
                                        <hr>
                                    <b><h5 class="text-center">Aluno</h5></b>
                                    <span name="aluno" id="aluno"></span>
                                        <br>
                                    <span name="matricula" id="matricula"></span>
                                        <br>
                                    <span name="data" id="data"></span>
                                </div>
                        </div>
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
    
<script>

var livro = false;
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                if($('#exemplar').is(':focus')) {
                    consultarLivro();
                    event.preventDefault();
                    return false;
                }
            }
        });

        $("#exemplar").change(function () {
            consultarLivro();

        });
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
                    $("#borda1").show();
                    $("#exemplar-error").hide();
                    $("#nomeLivro").html("<b>Nome do livro: </b>"+e.exemplar.livro.titulo);
                    $("#volumeLivro").html("<b>Volume do livro: </b>"+e.exemplar.livro.volume);
                    $("#autorLivro").html("<b>Autor do livro: </b>"+e.exemplar.livro.autor);

                    if (e.emprestado) {
                        livro = true;

                        $("#aluno").html("<b>Nome do aluno: </b>"+e.exemplar.emprestimos[0].aluno.nome);
                        $("#matricula").html("<b>Nº de matrícula: </b>"+e.exemplar.emprestimos[0].aluno.matricula);
                        $("#data").html("<b>Data de empréstimo: </b>"+e.exemplar.emprestimos[0].created_at.split(" ")[0]);
                        $("#exemplar").removeClass("is-invalid");
                        $("#exemplar").addClass("is-valid");
                        $("#idEmprestimo").val(e.exemplar.emprestimos[0].id);
                        $("#idExemplar").val(e.exemplar.code);
                    } else {
                        $('#exemplar').focus();
                        $("#exemplar-error").html("Livro não emprestado!");
                        $("#exemplar-error").show();
                        $("#exemplar").removeClass("is-valid");
                        $("#exemplar").addClass("is-invalid");
                        $("#idEmprestimo").val('');
                        $("#idExemplar").val('');

                        $("#aluno").html("");
                        $("#matricula").html("");
                        $("#data").html("");
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
                    $("#idEmprestimo").val('');
                    $("#idExemplar").val('');

                    $("#nomeLivro").html("");
                    $("#volumeLivro").html("");
                    $("#autorLivro").html("");
                    $("#fotoLivro").hide().attr('src', "");
                    $("#borda1").hide();

                    $("#aluno").html("");
                    $("#matricula").html("");
                    $("#data").html("");
                }
            });
    }

    function confirm(){
        
        if(livro) {
            Swal({
                title: 'Deseja registrar a devolução?',
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
        
</script>
@endsection