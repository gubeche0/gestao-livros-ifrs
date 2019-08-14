@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Turmas</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

            <div class="input-group mb-3">
                <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Categoria">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                </div>
            </div>

            <a href="{{ route('turma.create')}}">Nova Turma</a>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Descrição</th>
                        <th>Curso</th>
                        <th>Ativo</th>
                        <th>Ano</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turmas as $turma)
                    <tr>
                        <td>{{ $turma->nome }}</td>
                        <td>{{ $turma->curso->nome }}</td>
                        <td class=@if($turma->trashed()) 'inativo' @else 'ativo' @endif>{{ $turma->trashed() ? 'Inativo' : 'Ativo' }}</td>
                        <td>{{ $turma->ano }}</td>
                        <td>
                            <!-- <a class="text-dark" href='#'><i class="fas fa-info" aria-hidden="true"></i> Info</a> | -->
                            <a class="text-dark" href='{{ route('turma.edit', ['turma' => $turma->id]) }}'><i class="fas fa-edit"
                                    aria-hidden="true"></i> Editar</a> |
                            @if($turma->trashed())
                            <a class="text-dark" href="#" onclick="excluir('{{ route('turma.restore', ['livro' => $turma->id]) }}')"><i class="fas fa-trash-restore"
                                aria-hidden="true"></i> Ativar</a>
                            @else 
                            <a class="text-dark" href="#" onclick="excluir('{{ route('turma.delete', ['livro' => $turma->id]) }}')"><i class="fas fa-trash"
                                aria-hidden="true"></i> Inativar</a>
                            @endif
                        </td>
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
        $().ready(function() {
            $("#query").quicksearch('table tbody tr');
        })

        function excluir(url) {
            swal({
                title: 'Deseja inativar a turma?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, inativar!',
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
                title: 'Deseja reativar a turma?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, reativar!',
                cancelButtonText: "Cancelar",
                focusCancel: true
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        }
    </script>
@endsection