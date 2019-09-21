@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">{{$livro->titulo}}</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Exemplar">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                    </div>
                </div>
            
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Codigo De Barras</th>
                        <th>Status</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exemplares as $exemplar)
                    <tr>
                        <td>{{ $exemplar->code }}</td>
                        <td>{{ $exemplar->status }}</td>
                        <td>
                            @if($exemplar->emprestado())
                                Emprestado 
                            @elseif ($exemplar->trashed())
                                <span style="color:red"> Deletado </span>
                            @else
                                Disponivel
                            @endif
                        </td>
                        <td>
                            @if($exemplar->emprestado())
                                
                            @elseif ($exemplar->trashed())
                                <a class="text-dark" href="#" onclick="restaurar('{{ route('exemplar.restore', ['exemplar' => $exemplar->code]) }}')"><i class="fas fa-undo" aria-hidden="true"></i> Restaurar</a></td>
                            @else
                                <a class="text-dark" href="#" onclick="excluir('{{ route('exemplar.delete', ['exemplar' => $exemplar->code]) }}')"><i class="fas fa-trash" aria-hidden="true"></i> Excluir</a></td>
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
@endsection