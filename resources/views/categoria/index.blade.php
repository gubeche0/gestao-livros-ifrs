@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Categorias</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')
            

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Categoria">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                    </div>
                </div>

            <a href="{{ route('categoria.create') }}">Nova Categoria</a>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#Id</th>
                        <th width="60%">Nome</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>#{{ $categoria->id }}</td>
                        <td>{{ $categoria->nome }}</td>
                        <td>
                            <!-- <a class="text-dark" href='#'><i class="fas fa-info" aria-hidden="true"></i> Info</a> | -->
                            <a class="text-dark" href='{{ route('categoria.edit', ['categoria' => $categoria->id ]) }}'><i class="fas fa-edit" aria-hidden="true"></i> Editar</a> |
                            <a class="text-dark" href="#" onclick="excluir('{{ route('categoria.delete', ['categoria' => $categoria->id ]) }}')"><i class="fas fa-trash" aria-hidden="true"></i> Excluir</a>
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
        $("#query").quicksearch('table tbody tr')
        function excluir(url) {
        // var resposta = confirm("Deseja deletar a aluno?");
        swal({
            title: 'Deseja deletar a categoria?',
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