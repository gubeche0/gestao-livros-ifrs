@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel-heading">
        <h1 class="panel-title text-center my-3">{{$aluno->nome}}</h1>
    </div>
    <div class="form-row" id="aluno-row">
        <div class="col">
            <table class="table">
                <tr>
                    <th colspan="2">Nome do Aluno</th>
                    <td colspan="2">{{$aluno->nome}}</td>
                </tr>                  
                <tr>
                    <th colspan="2">Email do Aluno</th>
                    <td colspan="2">{{$aluno->email}}</td>
                </tr>                  
                <tr>
                    <th>Nº de Matrícula</th>
                    <td>{{$aluno->matricula}}</td>
                    <th>Curso do Aluno</th>
                    <td>{{$aluno->curso->abreviacao}}</td>
                </tr>                  
            </table>
        </div>
    </div>
    <div class="panel-heading">
        <h4 class="panel-title text-center my-3"> Livros que já pegou </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            @include('layouts.statusMessages')
            <table id="datatable-alunos" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Código do Livro</th>
                        <th scope="col">Livro</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>    
                    @foreach ($emprestimos as $emprestimo)
                        <tr>
                            <td>{{ $emprestimo->exemplar_code}}</td>
                            <td>{{ $emprestimo->exemplar->livro->titulo }}</td>
                            @if ($emprestimo->deleted_at <> null)
                                <td style="color:red">Devolvido</td>
                            @else
                                <td style="color:green">Emprestado</td>                                
                            @endif
                        </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection

@section('js')
<script>
        $("#query").quicksearch('table tbody tr')
        function excluir(url) {
            swal({
                title: 'Deseja deletar o exemplar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: "Cancelar",
                focusCancel: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }

            })
        }
        function restaurar(url) {
            swal({
                title: 'Deseja restaurar o exemplar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, restaurar!',
                cancelButtonText: "Cancelar",
                focusCancel: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }

            })
        }
    </script>

    <style>
    .table td, .table th{
        border-top: 1px solid white;
        border-bottom: 1px solid #dee2e6;
    }
    </style>
@endsection