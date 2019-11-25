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
                        <form id="form_pesquisa">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="">Curso:</label>
                                    <select class="chosen-select" name="cursos[]" id="filtro-cursos" multiple data-placeholder="Selecione os cursos">
                                        @foreach ($cursos as $curso)
                                            <option value="{{ $curso->id }}" @if(in_array($curso->id, (array) old('cursos'))) selected @endif>{{ $curso->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="">Turma:</label>
                                    <select class="chosen-select" name="turmas[]" id="filtro-turmas" multiple data-placeholder="Selecione as turmas">
                                        @foreach ($turmas as $turma)
                                            <option value="{{ $turma->id }}" @if(in_array($turma->id, (array) old('turmas'))) selected @endif>{{ $turma->nome }} - {{ $turma->ano }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="">Ano de vigência das turmas:</label>
                                    <select class="chosen-select" name="anos[]" id="filtro-anos" multiple data-placeholder="Selecione as turmas">
                                        @foreach ($anos as $ano)
                                            <option value="{{ $ano->ano }}" @if(in_array($ano->ano, (array) old('anos'))) selected @endif>{{ $ano->ano }}</option>
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
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="mostrarEmprestimoAtivo" name="emprestimosInativos" value="1" @if(old('emprestimosInativos') == 1) checked @endif>
                                        <label class="custom-control-label" for="mostrarEmprestimoAtivo">Listar emprestimos inativos</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <input name="" id="" class="btn btn-primary" type="submit" value="Pesquisar">
                                    <input name="" id="" class="btn btn-danger" type="reset" value="Limpar">
                                    <button id="btn-imprimir" class="btn btn-primary" style="float: right; display: inline-block" type="button">Imprimir</button>

                                </div>
                                <div class="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="filter-print">
                <h2>Filtros</h2>
                <div class="row" id="filters-list-print">
                        @if(count((array) old('cursos')) > 0)
                        <div class="col-sm">
                            <ul>
                                @foreach ($cursos as $curso)
                                    @if(in_array($curso->id, (array) old('cursos')))
                                        <li>{{ $curso->nome }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count((array) old('turmas')) > 0)
                        <div class="col-sm">
                            <ul>
                                @foreach ($turmas as $turma)
                                    @if(in_array($turma->id, (array) old('turmas')))
                                        <li>{{ $turma->nome }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count((array) old('anos')) > 0)
                        <div class="col-sm">
                            <ul>
                                @foreach ($anos as $ano)
                                    @if(in_array($ano->ano, (array) old('anos')))
                                        <li>{{ $ano->ano }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count((array) old('alunos')) > 0)
                        <div class="col-sm">
                            <ul>
                                @foreach ($alunos as $aluno)
                                    @if(in_array($aluno->id, (array) old('alunos')))
                                        <li>{{ $aluno->nome }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(count((array) old('livros')) > 0)
                        <div class="col-sm">
                            <ul>
                                @foreach ($livros as $livro)
                                    @if(in_array($livro->id, (array) old('livros')))
                                        <li>{{ $livro->titulo }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                                @if(!$emprestimo->trashed())
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
        $("#filtro-cursos").chosen();
        $("#filtro-turmas").chosen();
        $("#filtro-anos").chosen();
        $("#filtro-livros").chosen();
        $("#filtro-alunos").chosen();

        $("input[type='reset'], button[type='reset']").click(function(e){
            e.preventDefault();
            $('.chosen-select').val('').trigger('chosen:updated');
            $('#form_pesquisa').submit();
        });

        $('#btn-imprimir').click(function() {
            $('#filters-list-print').html('');
            var filtros = ['#filtro-cursos', '#filtro-turmas', '#filtro-anos', '#filtro-alunos', '#filtro-livros'];
            filtros.forEach(function(filtro) {
                if ($(filtro).val().length > 0) {
                var list = $('<ul>');
                $(filtro + ' option:selected').each(function(i, element) {                    
                    list.append(
                        $('<li>').text($(element).text())
                    );
                });
                $('#filters-list-print').append(
                    $('<div>', {class: 'col-sm'}).append(
                        list
                    )
                )
            }
            });
            
            window.print();
        });
    });
        
    </script>
@endsection

@section('css')
<style>

#filter-print {
    display: none;
}

@media print {
    #pesquisaAvancada {
        display: none;
    }

    #filter-print {
        display: block;
    }
}

</style>

@endsection