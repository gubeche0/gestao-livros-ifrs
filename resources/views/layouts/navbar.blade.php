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
                    @if(Auth::user()->isTipo(App\User::COORDENADOR, App\User::ADMINISTRADOR, App\User::PROFESSOR))
                    <li class="nav-item dropdown {{ Route::is('requisicaoLivro.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('requisicaoLivro.create') }}"></i> Requisitar Livro</a>
                    </li>
                    @endif

                    @if(Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR))
                    <li class="nav-item dropdown {{ Route::is('aluno*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('aluno.index') }}"></i> Alunos</a>
                    </li>
                   @endif

                   @if(Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR) )
                    <li class="nav-item dropdown {{ Route::is(['livro*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('livro.index') }}"></i> Livros</a>
                        </li>
                    @endif

                    @if(Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR) )
                    <li class="nav-item dropdown {{ Route::is(['emprestimo*']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('emprestimo.index') }}"></i> Empréstimos</a>
                    </li>
                    @endif

                    @if(Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR) )
                    <li class="nav-item dropdown {{ Route::is(['relatorio.emprestimo']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('relatorio.emprestimo') }}"></i>Relatório</a>
                    </li>
                    @endif

                    @if(Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR, App\User::COORDENADOR, App\User::PROFESSOR) )
                    <li class="nav-item dropdown {{ Route::is(['curso*', 'turma*', 'barcode*']) ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#" id="outros" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> Configurações</a>
                        <div class="dropdown-menu" aria-labelledby="outros">
                            @if ( Auth::user()->isTipo(App\User::ADMINISTRADOR) )
                                <a class="dropdown-item" href="{{ route('user.index') }}"></i>Cadastrar Usuários</a>
                            @endif
                            @if ( Auth::user()->isTipo(App\User::COORDENADORIA, App\User::ADMINISTRADOR) )
                            <a class="dropdown-item" href="{{ route('curso.index') }}">Cursos</a>
                            <a class="dropdown-item" href="{{ route('turma.index') }}">Turmas</a>
                            <a class="dropdown-item" href="{{ route('barcode.index') }}"><i class="fas fa-barcode"></i> Gerar Codigos de barras</a>
                            @endif
                            @if ( Auth::user()->isTipo(App\User::COORDENADOR, App\User::ADMINISTRADOR) )
                                <a class="dropdown-item" href="{{ route('area.index') }}">Áreas de conhecimento</a>
                                <a class="dropdown-item" href="{{ route('assunto.index') }}">Assuntos</a>
                            @endif
                            @if(!Auth::user()->isTipo(App\User::PROFESSOR) )
                            <hr>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user"></i> Perfil</a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>