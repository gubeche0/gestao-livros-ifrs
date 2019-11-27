@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title text-center my-3">Livros</h1>
            </div>
            <div class="panel-body">
                @include('layouts.statusMessages')

                <table id="datatable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>ISBN</th>
                            <th>Título</th>
                            <th>Volume</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livros as $livro)
                            <tr id="livro{{ $livro->id }}">
                                <td>{{ $livro->isbn}}</td>
                                <td>{{ $livro->titulo}}</td>
                                <td>{{ $livro->volume}}</td>
                                <td>{{ $livro->autor}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
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

    $(document).ready(function(){ 
        $('.btn-registrar').click(function() {
            showModalRegisterBook($(this).attr('data_livro'));
        });

        toastr.options.timeOut = 2000;
    });


</script>
@endsection