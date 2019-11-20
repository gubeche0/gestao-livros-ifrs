@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel-heading">
        <h1 class="panel-title text-center my-3"><i>{{$id}}</i> | {{$exemplar->livro->titulo}}</h1>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            @include('layouts.statusMessages')
            
            <table id="datatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Título do Livro</th>
                        <th>Nome do Aluno</th>
                        <th>Matrícula</th>
                        <th>Turma</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                        <tr>
                            <td><a href="{{ route('livro.exemplar', $exemplar->livro->id) }}">{{ $exemplar->livro->titulo}}</a></td>
                            <td><a href=" {{route('aluno.show', ["aluno" => $emprestimo->aluno->id])}} "> {{ $emprestimo->aluno->nome }} </a></td>
                            <td>{{ $emprestimo->aluno->matricula }}</td>
                            <td>{{ $emprestimo->turma->nome }}</td>
                            <td>
                                @if($emprestimo->deleted_at == null)
                                    <span style="color:green">Emprestado</span> 
                                @else
                                    Devolvido
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
    
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.uikit.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>

    $(document).ready(function() {
        $('#datatable').DataTable({
            stateSave: true,
            "pagingType": "numbers",
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoPostFix": "",
                "sInfoThousands": "",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sLengthMenu": "Resultados por página _MENU_",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
            }
        });
    }); 

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