@extends('layouts.app')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Empréstimos</h1>
        </div>
        <style>
            .devolver:hover{
                color:red;
            }
            .registrar:hover{
                color:green;
            }
        </style>
        <div class="panel-body">
            <div class="text-right">
                <a href="{{route('emprestimo.loan')}}"><button type="button" class="registrar btn btn-link btn-sm">Registrar empréstimo</button></a>
                <a href="{{route('emprestimo.devolution')}}"><button type="button" class="devolver btn btn-link btn-sm">Registrar devolução</button></a>
            </div>
            @include('layouts.statusMessages')
            <table id="datatable" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Aluno</th>
                        <th>Livro</th>
                        <th>Codigo</th>
                        <th>Data Empréstimo</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($emprestimos as $emprestimo)
                    <tr>
                        <td><a href=" {{route('aluno.show', ["aluno" => $emprestimo->aluno->id])}} ">{{ $emprestimo->aluno->nome }}</a></td>
                        <td><a href="{{ route('livro.exemplar', $emprestimo->exemplar->livro->id) }}">{{ $emprestimo->exemplar->livro->titulo }}</a></td>
                        <td><a href=" {{route('exemplar.historico', $emprestimo->exemplar->code)}} ">{{ $emprestimo->exemplar->code }}</a></td>
                        <td>{{ date('d/m/Y', strtotime($emprestimo->created_at)) }}</td>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
</script>
@endsection