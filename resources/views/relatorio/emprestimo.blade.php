@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Relatório de emprestimos</h1>
        </div>
        <div class="panel-body">
            @include('layouts.statusMessages')

            <div class="mb-2">
                <div class="" id="pesquisaAvancada" style="clear:both;">
                    <div class="card card-body">
                        <form>
                            <div class="row">
                                <div class="col-sm">
                                    <label for="">Turma:</label>
                                    <select class="chosen-select" name="turmas[]" id="filtro-turmas" multiple data-placeholder="Selecione as turmas">
                                        @foreach ($turmas as $turma)
                                            <option value="{{ $turma->id }}" @if(in_array($turma->id, (array) old('turmas'))) selected @endif>{{ $turma->nome }} - {{ $turma->ano }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="">Aluno:</label>
                                    <select class="chosen-select" name="alunos[]" id="filtro-alunos" multiple data-placeholder="Selecione os alunos">
                                        @foreach ($alunos as $aluno)
                                            <option value="{{ $aluno->id }}" @if(in_array($aluno->id, (array) old('alunos'))) selected @endif>{{ $aluno->nome }} - {{ $aluno->matricula }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="">Livro:</label>
                                    <select class="chosen-select" name="livros[]" id="filtro-livros" multiple data-placeholder="Selecione os livros">
                                        @foreach ($livros as $livro)
                                            <option value="{{ $livro->id }}" @if(in_array($livro->id, (array) old('livros'))) selected @endif>{{ $livro->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="mostrarEmprestimoAtivo" name="emprestimosInativos" value="1" @if(old('emprestimosInativos') == 1) checked @endif>
                                            <label class="custom-control-label" for="mostrarEmprestimoAtivo">Listar emprestimos inativos</label>
                                          </div>
                            </div>
                            <div class="row mt-2">
                                <div>
                                    <input name="" id="" class="btn btn-danger" type="reset" value="Limpar">
                                    <input name="" id="" class="btn btn-primary" type="submit" value="Pesquisar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" id="table">
                <thead class="thead-light">
                    <tr>
                        
                        <th>Aluno</th>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th>Livro</th>
                        <th>Codigo</th>
                        @if($emprestimosInativos)
                            <th>Status</th>
                        @endif
                        <th>Data do emprestimo</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($emprestimos as $emprestimo)
                    <tr>
                        <td>{{ $emprestimo->aluno->nome }}</td>
                        <td>{{ $emprestimo->aluno->curso->nome }}</td>
                        <td>{{ $emprestimo->turma->nome}} - {{$emprestimo->turma->ano}}</td>
                        <td>{{ $emprestimo->exemplar->livro->titulo }}</td>
                        <td>{{ $emprestimo->exemplar->code }}</td>
                        @if($emprestimosInativos)
                            <td>
                                @if($emprestimo->exemplar->emprestado())
                                    Emprestado 
                                @else
                                    Devolvido
                                @endif
                            </td>
                        @endif
                        <td>{{ date('d/m/Y', strtotime($emprestimo->created_at)) }}</td>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/chosen.jquery.min.js')}}"></script>
<script>
    $().ready(function() {
        $("#filtro-turmas").chosen();
        $("#filtro-livros").chosen();
        $("#filtro-alunos").chosen();

        $("input[type='reset'], button[type='reset']").click(function(e){
            e.preventDefault();

            $('.chosen-select').val('').trigger('chosen:updated');
        });
    });
        
    </script>
@endsection