@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Livros</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

            <div class="input-group mb-3">
                <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Categoria">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                </div>
            </div>

            <a href="{{ route('livro.create')}}">Novo Livro</a>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Volume</th>
                        <th>Autor</th>
                        <th>Estoque total</th>
                        <th>Estoque disponível</th>
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
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
    
<script>

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
            // console.log($(this).attr('data_livro'));
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