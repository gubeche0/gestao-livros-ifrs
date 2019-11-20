@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel-heading">
        <h1 class="panel-title text-center my-3">{{$aluno->nome}}</h1>
    </div>
    <div class="form-row" id="aluno-row">
        <div class="col">
                <span style="font-size:14pt"><b>Nome do Aluno</b>: {{$aluno->nome}}</span>
                  <br>
                <span style="font-size:14pt"><b>Email do Aluno</b>: {{$aluno->email}}</span>
                  <br>
                <span style="font-size:14pt"><b>Nº de Matrícula</b>: {{$aluno->matricula}}</span>
                  <br>
                <span style="font-size:14pt"><b>Curso do Aluno</b>: {{$aluno->curso->nome}}</span>
        </div>
    </div>
    <div class="panel-heading">
        <h4 class="panel-title text-center my-3"> Livros que já pegou </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            @include('layouts.statusMessages')
            <table id="datatable" class="table align-items-center table-flush">
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
                            <td><a href=" {{route('exemplar.historico', $emprestimo->exemplar_code)}} ">{{ $emprestimo->exemplar_code}}</td>
                            <td><a href=" {{route('livro.exemplar', $emprestimo->exemplar->livro->id)}} ">{{ $emprestimo->exemplar->livro->titulo }}</a></td>
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
                "sEmptyTable": "Aluno não possui nehum empréstimo",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoPostFix": "",
                "sInfoThousands": "",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sLengthMenu": "Resultados por página _MENU_",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Aluno não possui nehum empréstimo",
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