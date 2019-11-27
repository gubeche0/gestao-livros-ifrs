@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title text-center my-3">Requisições de livros</h1>
        </div>
        <div class="panel-body">
            <div class="text-right"><a href="{{route('requisicaoLivro.create')}}"><button type="button" class="btn btn-link">Nova Requisição</button></a></div>
            @include('layouts.statusMessages')

            <div class="mb-2">
                <div class="" id="pesquisaAvancada" style="clear:both;">
                    <div class="card card-body">
                        <form id="form_pesquisa">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="">Livro:</label>
                                    <div>
                                        <input placeholder="Pesquisar" type="text" name="livro" id="filtro-livro" class="form-control" value='@if(old('livro') != null){{ old('livro') }}@endif'>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="">Área de conhecimento:</label>
                                    <div>

                                        <select class="chosen-select" name="areas[]" id="filtro-areas" multiple data-placeholder="Selecione as áreas de conhecimento">
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" @if(in_array($area->id, (array) old('areas'))) selected @endif>{{ $area->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="">Assunto:</label>
                                    <div>

                                        <select class="chosen-select" name="assuntos[]" id="filtro-assuntos" multiple data-placeholder="Selecione as turmas">
                                            @foreach ($assuntos as $assunto)
                                            <option value="{{ $assunto->id }}" @if(in_array($assunto->id, (array) old('assuntos'))) selected @endif>{{ $assunto->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="">Professor solicitante:</label>
                                    <div>

                                        <select class="chosen-select" name="professores[]" id="filtro-professores" multiple data-placeholder="Selecione os alunos">
                                            @foreach ($professores as $professor)
                                            <option value="{{ $professor->id }}" @if(in_array($professor->id, (array) old('professores'))) selected @endif>{{ $professor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <input name="" id="" class="btn btn-primary" type="submit" value="Pesquisar">
                                    <input name="" id="" class="btn btn-danger" type="reset" value="Limpar">
                                    {{-- <button id="btn-imprimir" class="btn btn-primary" style="float: right; display: inline-block" type="button">Imprimir</button> --}}

                                </div>
                                <div class="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div id="filter-print">
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
            </div> --}}
            <table class="table table-striped table-bordered table-hover" id="table">
                <thead class="thead-light">
                    <tr>
                        
                        <th>Titulo</th>
                        <th>Volume</th>
                        <th>Área</th>
                        <th>Assunto</th>
                        <th>Professor</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($livros as $livro)
                    <tr>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->volume }}</td>
                        <td>{{ $livro->area->nome }}</td>
                        <td>{{ $livro->assunto->nome }}</td>
                        <td>{{ $livro->user->name }}</td>
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
        $("#filtro-areas").chosen();
        $("#filtro-assuntos").chosen();
        $("#filtro-professores").chosen();

        $("input[type='reset'], button[type='reset']").click(function(e){
            e.preventDefault();
            $('.chosen-select').val('').trigger('chosen:updated');
            $('#filtro-livro').val('');
            $('#form_pesquisa').submit();
        });

        // $('#btn-imprimir').click(function() {
        //     window.print();
        // });
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