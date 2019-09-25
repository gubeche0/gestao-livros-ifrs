@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title text-center my-3">Gestão de Livros</h1>
            </div>
            <div class="panel-body">
                @include('layouts.statusMessages')
                {{-- <table class="table table-striped table-bordered table-hover"> --}}
                <table id="datatable" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>ISBN</th>
                            <th>Título</th>
                            <th>Volume</th>
                            <th>Autor</th>
                            <th>Estoque</th>
                            <th>Disponível</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livros as $livro)
                            <tr id="livro{{ $livro->id }}">
                                <td>{{ $livro->isbn}}</td>
                                <td>
                                    <a href="{{ route('livro.exemplar', $livro->id) }}">
                                        {{ $livro->titulo}}
                                    </a>
                                </td>
                                <td>{{ $livro->volume}}</td>
                                <td>{{ $livro->autor}}</td>
                                <td class="estoque">{{ $livro->estoque() }}</td>
                                <td class="estoque-disponivel">{{ $livro->disponiveis()}}</td>
                                <td>
                                    <a class="text-dark btn-registrar" data_livro="{{$livro->id}}" id="" href="#">
                                        <i class="fas fa-plus" aria-hidden="true"></i> Registrar exemplar
                                    </a> |
                                    <a class="text-dark" href='{{ route('livro.edit', ['livro' => $livro->id]) }}'><i class="fas fa-edit"
                                            aria-hidden="true"></i> Editar</a> |
                                    <a class="text-dark" href="#" onclick="excluir('{{ route('livro.delete', ['livro' => $livro->id]) }}')"><i class="fas fa-trash"
                                            aria-hidden="true"></i> Excluir</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    

@endsection

@section('js')
{{-- <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script> --}}

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

    $("#query").quicksearch('table tbody tr')
    function excluir(url) {
        swal({
            title: 'Deseja deletar o livro?',
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

    $(document).ready(function(){ 
        $('.btn-registrar').click(function() {
            showModalRegister($(this).attr('data_livro'));
        });

        toastr.options.timeOut = 2000;
    });

    function showModalRegister(livro){
        Swal.fire({
        title: 'Registrar exemplares',
        input: 'text',
        inputAttributes: {
          id: 'codeBar',
        },
        showConfirmButton:true,
        showCancelButton: true,
        confirmButtonText:'Registrar',
        cancelButtonText: 'Fechar',
        cancelButtonColor: 'red',
        preConfirm: function() {
            return false;
        },
        onBeforeOpen: function(){
            $('.swal2-confirm').unbind().click(function() {
                register($('#codeBar').val(), livro);
                
            })
            $('#codeBar').keydown(function (event) {
                if (event.keyCode == 13) {
                    register($('#codeBar').val(), livro);
                    event.preventDefault();
                    return false;
                }
            });
        }});
    }

    function register(code, livro){
        // TODO: Validação do codigo de barra
        if(!code) {
            return;
        }
        $.ajax({
            method: "post",
            url: "/api/exemplar/" + code + '/editar',
            dataType: "json",
            data: {
                'livro': livro
            }
        }).done(function (e) {
            console.log(e);
            $('#codeBar').val('');
            if (e.status) {
                toastr.success('Registrado com sucesso!');
                var estoque = $('#livro' + e.exemplar.livro.id + ' .estoque');
                estoque.html((estoque.html() / 1) + 1)
                var estoqueDisponivel = $('#livro' + e.exemplar.livro.id + ' .estoque-disponivel');
                estoqueDisponivel.html((estoqueDisponivel.html() / 1) + 1)
            } else {
                if (e.error) {
                    toastr.warning(e.error);
                } else {
                    toastr.warning('Ocorreu um erro ao registrar!');
                }  
            }
        });
    }


</script>
@endsection