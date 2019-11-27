@extends('layouts.app')

@section('content')

<center>
        @if (Session::has('message_danger'))
            <div class="alert alert-danger" style="width:50%">{{ Session::get('message_danger') }}</div>
        @endif
    </center>
    <div class="container" style="height: 100%">
        <div class="form-row">
            <div class="col-4 d-flex align-items-center" style="margin-top:15px;">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-graduation-cap fa-8x mb-4"></i>
                    <h5 class="card-title">Alunos</h5>
                    <a href=" {{route('aluno.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Alunos</a>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center" style="margin-top:15px;">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-barcode fa-8x mb-4"></i>
                    <h5 class="card-title">Empréstimos</h5>
                    <a href=" {{route('emprestimo.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Empréstimos</a>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center" style="margin-top:15px;">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-book fa-8x mb-4"></i>
                    <h5 class="card-title">Livros</h5>
                    <a href=" {{route('livro.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Livros</a>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center" style="margin-top:15px;">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-users fa-8x mb-4"></i>
                    <h5 class="card-title">Usuários</h5>
                    <a href=" {{route('user.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Usuários</a>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center" style="margin-top:15px;">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-user-graduate fa-8x mb-4"></i>
                    <h5 class="card-title">Requisição de livros</h5>
                    <a href=" {{route('requisicaoLivro.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Requisições</a>
                </div>
            </div>
        </div>
    </div>
@endsection