@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    <form method="post">
        @csrf
        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Livro:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="livro" id="livro">
                    
                    @foreach ($livros as $livro)
                    <option value="{{ $livro->id }}" @if(isset($exemplar) && $exemplar->livro->id == $livro->id) selected @endif >{{ $livro->nome}}</option> 
                    @endforeach
                    
                </select> 
            </div> 
        </div> 
         
        @if(!isset($exemplar))
            <div class="form-group row">

                <label for="nome" class="col-sm-2 col-form-label">Quantidade:</label>
                <div class="col-sm-10">

                    <input type="number" min="0" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade" required value="">
                </div>
            </div>
        @endif
        <div class="form-group row">
            <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
            <input name="cancelar" id="cancelar" class="btn btn-danger col ml-1" type="reset" value="Cancelar">
        </div>

    </form>
    
</div>
<div style="display: none;" id="barcodes"></div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script>
    function gerarCodes(vetor) {
        $('#barcodes').html('');
        for (var x = 0; x < vetor.length; x++) {
     
            $("#barcodes").prepend("<svg style='border: 1px solid black; padding:5px; margin: 2px;' id='barcode" + x +"'></svg>")
            JsBarcode("#barcode" + x , vetor[x]);
            
        }

        var conteudo = $("#barcodes").html();
        var telaImpressao = window.open('about:blank');

        telaImpressao.document.write(conteudo);
        telaImpressao.window.print();
        telaImpressao.window.close();

    }

    @if(isset($coders))

        gerarCodes(@json($coders));

    @endif

</script>
@endsection