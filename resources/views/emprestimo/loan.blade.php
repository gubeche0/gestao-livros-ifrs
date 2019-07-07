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
                        <label id="exemplar-error" class="is-invalid text-danger" for="exemplar" style="display: none;">Este campo é requerido.</label>
                    </div>
                </div>

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
            </div>
            <div class="col-2">

                <img id="fotoLivro" src="" class="img-thumbnail" style="display: none">
            </div>
        </div>


        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Aluno:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="aluno" id="aluno">

                    @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->id }}">{{ $aluno->nome }} - {{ $aluno->matricula }}</option>
                    @endforeach
                    
                </select>
            </div>
        </div>

        <div class="form-group row">

            <label for="nome" class="col-sm-2 col-form-label">Periodo de entrega:</label>
            <div class="col-sm-10">

                <input type="number" name="periodoEntrega" id="periodoEntrega" class="form-control" placeholder="Codigo de barras"
                    required value="1">
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
                }
            });

        });



    });
        
    </script>
@endsection