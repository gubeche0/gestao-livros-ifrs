@extends('layouts.app')    

@section('content')
        
<div class="container">
        <div id="form" class="panel-heading">
                <h1 class="panel-title text-center my-3">Gerar códigos de barra</h1>
            </div>
    @include('layouts.statusMessages')
    <form method="post" id="form">
        @csrf
         
        <div class="form-group row">
            <label for="titulo" class="col-sm-2 col-form-label">Quantidade:</label>
            <div class="col-sm-10">
                <input type="number" min="0" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade" required value="">
            </div>
        </div>
        
        <div class="form-group row">
            <input name="salvar" id="salvar" class="btn btn-primary col" type="submit" value="Salvar">
            <a href=" {{route('livro.index')}} " class="btn btn-danger col ml-1" > Cancelar </a>
        </div>

    </form>
    
</div>
<div id="barcodes"></div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script>
    function gerarCodes(vetor) {
        $('#barcodes').html('');
        for (var x = 0; x < vetor.length; x++) {
     
            $("#barcodes").append("<svg style='border: 1px solid black; padding:5px; margin: 4px;' id='barcode" + x +"'></svg>")
            JsBarcode("#barcode" + x , vetor[x], {
                width: 2
            });
        }
        window.print();
        // var conteudo = $("#barcodes").html();
        // var telaImpressao = window.open('about:blank');

        // telaImpressao.document.write(conteudo);
        // telaImpressao.window.print();
        // telaImpressao.window.close();
    }

    @if(isset($codes))
    
        gerarCodes(@json($codes));

    @endif

</script>
@endsection

@section('css')

<style>

    #barcodes {
        display: none;
    }

    @media print {
        #barcodes {
            display: block;
        }

        #form {
            display: none;
        }
    }

</style>
@endsection