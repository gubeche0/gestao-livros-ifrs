@extends('layouts.app')    

@section('content')
        
<div class="container">
    @include('layouts.statusMessages')
    
        <div class="form-group row">
            <label for="livro" class="col-sm-2 col-form-label">Livro:</label>
            <div class="col-sm-10">
                <select class="custom-select" name="livro" id="livro">
                    
                    @foreach ($livros as $livro)
                    <option value="{{ $livro->id }}" @if(isset($exemplar) && $exemplar->livro->id == $livro->id) selected @endif >{{ $livro->titulo}}</option> 
                    @endforeach
                    
                </select> 
            </div> 
        </div> 
         
        <div class="form-group row">
            <input name="Registrar" id="btn-registrar" class="btn btn-primary col" type="button" value="Salvar">
            <input name="cancelar" id="cancelar" class="btn btn-danger col ml-1" type="reset" value="Cancelar">
        </div>
    
</div>
<div style="display: none;" id="barcodes"></div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script>

    $(document).ready(function(){ 
        $('#btn-registrar').click(function() {
            showModalRegister();
        });

        toastr.options.timeOut = 2000;
    });

    function showModalRegister(){
        Swal.fire({
        title: 'Registrar exemplares',
        input: 'text',
        inputAttributes: {
          id: 'codeBar',
        },
        showConfirmButton:true,
        showCancelButton: true,
        confirmButtonText:'Registrar',
        cancelButtonText: 'Fechar',
        cancelButtonColor: 'red',
        preConfirm: function() {
            return false;
        },
        onBeforeOpen: function(){
            $('.swal2-confirm').unbind().click(function() {
                register($('#codeBar').val());
                
            })
            $('#codeBar').keydown(function (event) {
                if (event.keyCode == 13) {
                    register($('#codeBar').val());
                    event.preventDefault();
                    return false;
                }
            });
        }});
    }

    function register(code){
        // TODO: Validação do codigo de barra
        if(!code) {
            return;
        }
        $.ajax({
            method: "post",
            url: "/api/exemplar/" + code + '/editar',
            dataType: "json",
            data: {
                'livro': $('#livro').val()
            }
        }).done(function (e) {
            console.log(e);
            $('#codeBar').val('');
            if (e.status) {
                toastr.success('Registrado com sucesso!');
            } else {
                if (e.error) {
                    toastr.warning(e.error);
                } else {
                    toastr.warning('Ocorreu um erro ao registrar!');
                }  
            }
        });
    }


</script>
@endsection