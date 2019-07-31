@extends('layouts.app')
@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Usuários</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

            <div class="input-group mb-3">
                <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Usuários">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                </div>
            </div>

            <a href="{{ route('user.create')}}">Novo Usuário</a>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
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
    </script>
@endsection