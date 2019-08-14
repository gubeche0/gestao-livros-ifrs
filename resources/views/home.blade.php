@extends('layouts.app')

<style>
    .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}
</style>

@section('content')
<div class="container">
    <div class=".flex-center" id="feature">
        <div class="row">
            <div class="text-center">
                <h3>Bem vindo a gestão de livros IFRS</h3>
                <p>Aqui você encontra as principais páginas para <br>a gestão de livros do IFRS Campus Bento Gonçalves</p>
            </div>
            
            <a href="/alunos">

                <div class="col-md-3 wow fadeInLeft" data-wow-offset="0" data-wow-delay="0.3s">

                    <div class="text-center">

                        <div class="hi-icon-wrap hi-icon-effect">

                            <i class="fa fa-user" aria-hidden="true"></i>

                            <h2>Listagem de alunos</h2>

                            <p>Aqui você vai para página de listagem dos alunos</p>

                        </div>

                    </div>

                </div>

            </a>

            <a href="/livros">

                <div class="col-md-3 wow fadeInRight" data-wow-offset="0" data-wow-delay="0.3s">

                    <div class="text-center">

                        <div class="hi-icon-wrap hi-icon-effect">

                            <i class="fa fa-list" aria-hidden="true"></i>

                            <h2>Listagem dos livros</h2>

                            <p>Aqui você vai para página de listagem dos livros</p>

                        </div>

                    </div>

                </div>

            </a>

            <a href="/emprestimo">

                <div class="col-md-3 wow fadeInRight" data-wow-offset="0" data-wow-delay="0.3s">


                    <div class="text-center">

                        <div class="hi-icon-wrap hi-icon-effect">

                            <i class="fa fa-book" aria-hidden="true"></i>

                            <h2>Listagem dos empréstimos</h2>

                            <p>Aqui você vai para a página de listagem de empréstimos</p>

                        </div>

                    </div>

                </div>

            </a>

            <a href="/emprestimo/registrar">

                <div class="col-md-3 wow fadeInLeft" data-wow-offset="0" data-wow-delay="0.3s">

                    <div class="text-center">

                        <div class="hi-icon-wrap hi-icon-effect">

                            <i class="fa fa-plus"></i>

                            <h2>Cadastro de Empréstimos</h2>

                            <p>Aqui você vai para a página de cadastro de empréstimos</p>

                        </div>

                    </div>

                </div>

        </div>

    </div>
</div>
@endsection
