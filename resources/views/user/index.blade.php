@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title text-center my-3">Usuários</h1>
            </div>
            <div class="panel-body">
                <div class="text-right"><a href="{{route('user.create')}}"><button type="button" class="btn btn-link">Adicionar usuários</button></a></div>
                @include('layouts.statusMessages')
                <table id="datatable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Função</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>    
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->tipo == 1)
                                        Coordenadoria
                                    @endif
                                    @if ($user->tipo == 2)
                                        Administrador
                                    @endif
                                    @if ($user->tipo == 3)
                                        Coordenador de curso
                                    @endif
                                    @if ($user->tipo == 4)
                                        Professor
                                    @endif
                                </td>
                                <td>
                                    <a class="text-dark" href='{{ route('user.edit', ["user" => $user->id]) }}'>
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                        Editar
                                    </a> |
                                    <a class="text-dark" href="#" onclick="excluir('{{ route('user.delete', ['user' => $user->id]) }}')">
                                        <i class="fas fa-trash" aria-hidden="true"></i> 
                                        Excluir
                                    </a>
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

    function excluir(url) {
        swal({
            title: 'Deseja deletar o usuário?',
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

</script>
@endsection