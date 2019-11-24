@extends('layouts.app')

@section('content')
    <div class="container" style="height: 100%">
        <div class="form-row">
            <div class="col-4 d-flex align-items-center" style="height: 80vh">
                <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                    <i class="fas fa-users fa-8x mb-4"></i>
                    <h5 class="card-title">Alunos</h5>
                    <a href=" {{route('aluno.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Alunos</a>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center" style="height: 80vh">
                    <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                        <i class="fas fa-barcode fa-8x mb-4"></i>
                        <h5 class="card-title">Empréstimos</h5>
                        <a href=" {{route('emprestimo.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Empréstimos</a>
                    </div>
                </div>
                <div class="col-4 d-flex align-items-center" style="height: 80vh">
                    <div class="card-body text-center" style="border: 1px solid #A9A9A9; border-radius:14px">
                        <i class="fas fa-book fa-8x mb-4"></i>
                        <h5 class="card-title">Livros</h5>
                        <a href=" {{route('livro.index')}} " class="btn" style="color:white; background-color:#17882C">Listagem de Livros</a>
                    </div>
                </div>
        </div>
        
    </div>
@endsection