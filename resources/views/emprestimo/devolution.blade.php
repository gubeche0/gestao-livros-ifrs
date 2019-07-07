@extends('layouts.app')
@section('content')

<div class="container">
        @include('layouts.statusMessages')
        <form method="post" id="form" onsubmit="if(!livro) return false">
            @csrf
            <div class="form-row" id="livro-row">
                <div class="col">
                    <div class="form-group row">
    
                        <label for="nome" class="col-sm-2 col-form-label">Codigo de barras:</label>
                        <div class="col-sm-10">
    
                            <input type="number" name="exemplar" id="exemplar" class="form-control" placeholder="Codigo de barras"
                                value="" autofocus>
                            <label id="exemplar-error" class="is-invalid text-danger" for="exemplar" style="display: none;">Este
                                campo é requerido.</label>
                        </div>
                    </div>
                    <input type="hidden" id="idEmprestimo" name="idEmprestimo">
                    <input type="hidden" id="idExemplar" name="idExemplar">
    
                    <div class="form-group row">
    
                        <label for="nome" class="col-sm-2 col-form-label">Nome do livro:</label>
                        <div class="col-sm-10">
    
                            <input type="text" name="nomeLivro" id="nomeLivro" class="form-control" placeholder="Nome do Livro"
                                readonly value="">
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
                    <div class="form-group row">
    
                        <label for="nome" class="col-sm-2 col-form-label">Status do livro:</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statusLivro" name="statusLivro" checked>
                                <label class="custom-control-label" for="statusLivro">Utilizavel</label>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-2">
    
                    <img id="fotoLivro" src="" class="img-thumbnail" style="display: none"> 
                </div>
            </div>
    
            <h2 class="text-center my-4">Aluno</h2>
            <div class="form-group row">
    
                <label for="nome" class="col-sm-2 col-form-label">Nome do Aluno:</label>
                <div class="col-sm-10">
    
                    <input type="text" name="aluno" id="aluno" class="form-control" placeholder="Nome do Aluno" disabled>
                </div>
            </div>
            <div class="form-group row">
    
                <label for="nome" class="col-sm-2 col-form-label">Matricula do Aluno:</label>
                <div class="col-sm-10">
    
                    <input type="text" name="matricula" id="matricula" class="form-control" placeholder="Matricula do Aluno"
                        disabled>
                </div>
            </div>
    
            <div class="form-group row">
    
                <label for="nome" class="col-sm-2 col-form-label">Data do emprestimo:</label>
                <div class="col-sm-10">
    
                    <input type="date" name="data" id="data" class="form-control" disabled>
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
    
<script>

var livro = false;
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $("#exemplar").change(function () {
            $.ajax({
                method: "GET",
                url: "/api/exemplar/" + this.value,
                dataType: "json",

            }).done(function (e) {
                console.log(e);
                if (e.status) {
                    $("#exemplar-error").hide();
                    $("#nomeLivro").val(e.exemplar.livro.nome);
                    $("#volumeLivro").val(e.exemplar.livro.volume);
                    $("#autorLivro").val(e.exemplar.livro.autor);


                    if (e.emprestado) {
                        livro = true;
                        $("#aluno").val(e.exemplar.emprestimos[0].aluno.nome);
                        $("#matricula").val(e.exemplar.emprestimos[0].aluno.matricula);
                        $("#data").val(e.exemplar.emprestimos[0].created_at.split(" ")[0]);
                        $("#exemplar").removeClass("is-invalid");
                        $("#exemplar").addClass("is-valid");
                        $("#idEmprestimo").val(e.exemplar.emprestimos[0].id);
                        $("#idExemplar").val(e.exemplar.id);
                    } else {
                        $("#exemplar-error").html("Livro não emprestado!");
                        $("#exemplar-error").show();
                        $("#exemplar").removeClass("is-valid");
                        $("#exemplar").addClass("is-invalid");

                        $("#aluno").val("");
                        $("#matricula").val("");
                        $("#data").val("");
                        livro = false;
                    }

                    if (e.exemplar.livro.urlFoto) {
                        $("#fotoLivro").show().attr('src', '/storage/fotoLivro/' + e.exemplar.livro.urlFoto);
                    } else {
                        $("#fotoLivro").hide().attr('src', "");
                    }
                } else {
                    livro = false;
                    $("#exemplar-error").html("Livro Não cadastrado!");
                    $("#exemplar-error").show();
                    $("#exemplar").removeClass("is-valid");
                    $("#exemplar").addClass("is-invalid");

                    $("#nomeLivro").val("");
                    $("#volumeLivro").val("");
                    $("#autorLivro").val("");
                    $("#fotoLivro").hide().attr('src', "");

                    $("#aluno").val("");
                    $("#matricula").val("");
                    $("#data").val("");
                }
            });

        });



    });

        
</script>
@endsection