@extends('layouts.app')
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Gestão de Emprestimos</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Alunos">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                    </div>
                </div>

            
            <a href="{{ route('emprestimo.loan') }}">Novo Emprestimo</a>
            <table class="table table-striped table-bordered table-hover" id="table">
                <thead class="thead-light">
                    <tr>
                        <th>#Id</th>
                        <th>Aluno</th>
                        <th>Livro</th>
                        <th>Codigo</th>
                        <th>Data Emprestimo</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($emprestimos as $emprestimo)
                    <tr>
                        <td>{{ $emprestimo->id }}</td>
                        <td>{{ $emprestimo->aluno->nome }}</td>
                        <td>{{ $emprestimo->exemplar->livro->titulo }}</td>
                        <td>{{ $emprestimo->exemplar->id }}</td>
                        <td>{{ date('d/m/Y', strtotime($emprestimo->created_at)) }}</td>
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
        
    </script>
@endsection