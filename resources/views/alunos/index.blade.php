@extends('layouts.app')


@section('content')
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title text-center my-3">Gestão de Alunos</h1>
            </div>
            <div class="panel-body">
                @include('layouts.statusMessages')
                
                <form>
    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="query" name="query" placeholder="Pesquisar Alunos" value="@isset($query){{ $query }} @endif">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" type="button" id="button-addon2">Pesquisar</button>
                        </div>
                    </div>
                </form>
    
    
    
                {{-- <p class="float-right">
                    <a class="text-right" href="#">Importar Alunos</a>
                </p> --}}
                <a href="{{ route('alunos.create') }}">Novo Aluno</a>
                <table class="table table-striped table-bordered table-hover" id="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Email</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($alunos as $aluno)
                            
                        
                        <tr>
                            <td>{{ $aluno->matricula }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->curso->abreviacao }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>
    
                                <a class="text-dark" href='{{ route('alunos.edit', ["aluno" => $aluno->id]) }}'><i class="fas fa-edit"
                                        aria-hidden="true"></i> Editar</a> |
                                <a class="text-dark" href="#" onclick="excluir('{{ route('alunos.delete', ['aluno' => $aluno->id]) }}')"><i class="fas fa-trash"
                                        aria-hidden="true"></i> Excluir</a></td>
                        </tr>
                        @endforeach 

                    </tbody>
                </table>
                {{-- <nav>
                    <ul class="pagination justify-content-end">
                            <li class='page-item {if="$page == 1"}disabled{/if}'>
                                <a class="page-link" href='/alunos?page={$page - 1}&query={$query}'>Anterior</a>
                            </li>
                        {loop="$pages"}
                            <li class="page-item {if="$page == $value['text']"} active {/if}"><a class='page-link' href='{$value["href"]}'>{$value["text"]}</a></li>
                        {/loop}
                        <li class='page-item {if="count($pages) <= $page"}disabled{/if}'>
                            <a class="page-link" href='/alunos?page={$page + 1}&query={$query}'>Proximo</a>
                        </li>
                        
                    </ul>
                </nav> --}}
    
            </div>
        </div>
    </div>
    
    
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // $("#query").quicksearch('table tbody tr') 
        function excluir(url) {
            // var resposta = confirm("Deseja deletar a aluno?");
            swal({
                title: 'Deseja deletar o aluno?',
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
    </body>
    
    </html>
@endsection