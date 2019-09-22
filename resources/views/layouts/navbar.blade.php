<nav class="navbar navbar-inverse navbar-expand-xl navbar-dark mb-4" style="background-color: #17882C;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/if2.png') }}" alt="Logo do IFRS" height="30" class="d-inline-block align-top">
                {{ config('app.alias', 'Gestão Livros') }}
            </a>

            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    
                    <li class="nav-item dropdown {{ Route::is('aluno*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="alunos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> Alunos</a>
                        <div class="dropdown-menu" aria-labelledby="alunos">
                            <a class="dropdown-item" href="{{ route('aluno.index') }}"><i class="fas fa-list"></i> Listar</a>
                            <a class="dropdown-item" href="{{ route('aluno.create') }}"><i class="fas fa-plus"></i> Adicionar</a>
                        </div>
                    </li>
                   

                    <li class="nav-item dropdown {{ Route::is(['livro*', 'barcode*']) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="livros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> Livros</a>
                        <div class="dropdown-menu" aria-labelledby="livros">
                            <a class="dropdown-item" href="{{ route('livro.index') }}"><i class="fas fa-list"></i> Listar</a>
                            <a class="dropdown-item" href="{{ route('livro.create') }}"><i class="fas fa-plus"></i> Adicionar</a>
                            <a class="dropdown-item" href="{{ route('barcode.index') }}"><i class="fas fa-barcode"></i> Gerar Codigos de barras</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown {{ Route::is(['emprestimo*', 'relatorio.emprestimo']) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="emprestimos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> Empréstimos</a>
                        <div class="dropdown-menu" aria-labelledby="emprestimos">
                            <a class="dropdown-item" href="{{ route('emprestimo.index') }}"><i class="fas fa-list"></i> Listar</a>
                            <a class="dropdown-item" href="{{ route('relatorio.emprestimo') }}"><i class="fas fa-file-contract"></i> Gerar Relatório</a>
                            <a class="dropdown-item" href="{{ route('emprestimo.loan') }}"><i class="fas fa-plus"></i> Registrar emprestimo</a>
                            <a class="dropdown-item" href="{{ route('emprestimo.devolution') }}"><i class="fas fa-minus"></i> Registrar devolução</a>
                        </div>
                    </li>
                    <li class="nav-item">

                    
                    <li class="nav-item dropdown {{ Route::is(['curso*', 'turma*']) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="outros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> Outros</a>
                        <div class="dropdown-menu" aria-labelledby="outros">
                            <!-- <a class="dropdown-item" href="#">Configurações</a>
                            <div class="dropdown-divider"></div> -->
                            <a class="dropdown-item" href="{{ route('curso.index') }}">Cursos</a>
                            <a class="dropdown-item" href="{{ route('turma.index') }}">Turmas</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>