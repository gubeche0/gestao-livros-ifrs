@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Exemplares</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Exemplar">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                    </div>
                </div>
            
            <a href="{{ route('exemplar.create') }}">Novo exemplar</a>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Codigo De Barras</th>
                        <th>Livro</th>
                        <th>Status</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exemplares as $exemplar)
                    <tr>
                        <td>{{ $exemplar->id }}</td>
                        <td>{{ $exemplar->livro->titulo }}</td>
                        <td>{{ $exemplar->status }}</td>
                        <td>@if($exemplar->emprestado())Emprestado @else Disponivel @endif</td>
                        <td>
                            <!-- <a class="text-dark" href='#'><i class="fas fa-info" aria-hidden="true"></i> Info</a> | -->
                            <a class="text-dark" href='{{ route('exemplar.edit', ['exemplar' => $exemplar->id]) }}'><i class="fas fa-edit" aria-hidden="true"></i> Editar</a> |
                            <a class="text-dark" href="#" onclick="excluir('{{ route('exemplar.delete', ['exemplar' => $exemplar->id]) }}')"><i class="fas fa-trash" aria-hidden="true"></i> Excluir</a></td>
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
    </script>
@endsection