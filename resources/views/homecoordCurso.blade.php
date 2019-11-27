@extends('layouts.app')

@section('content')
    <center>
        @if (Session::has('message_danger'))
            <div class="alert alert-danger" style="width:50%">{{ Session::get('message_danger') }}</div>
        @endif
    </center>
    <div class="container" style="height: 100%">
        <div class="form-row" style="margin-top:15%;">
            <div class="col-4 d-flex align-items-center">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-list fa-8x mb-4"></i>
                    <h5 class="card-title">Requisição de livros</h5>
                    <a href=" {{route('requisicaoLivro.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Requisições</a>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-book fa-8x mb-4"></i>
                    <h5 class="card-title">Livros</h5>
                    <a href=" {{route('listlivro.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Livros</a>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-users fa-8x mb-4"></i>
                    <h5 class="card-title">Professores</h5>
                    <a href=" {{route('professor.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Professores</a>
                </div>
            </div>
        </div>
    </div>
@endsection