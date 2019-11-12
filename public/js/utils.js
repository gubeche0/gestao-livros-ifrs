
// function showModalRegisterBook(livro){
//     Swal.fire({
//     title: 'Registrar exemplares',
//     input: 'text',
//     inputAttributes: {
//       id: 'codeBar',
//     },
//     showConfirmButton:true,
//     showCancelButton: true,
//     confirmButtonText:'Registrar',
//     cancelButtonText: 'Fechar',
//     cancelButtonColor: 'red',
//     preConfirm: function() {
//         return false;
//     },
//     onBeforeOpen: function(){
//         $('.swal2-confirm').unbind().click(function() {
//             register($('#codeBar').val(), livro);
            
//         })
//         $('#codeBar').keydown(function (event) {
//             if (event.keyCode == 13) {
//                 registerBook($('#codeBar').val(), livro);
//                 event.preventDefault();
//                 return false;
//             }
//         });
//     }});
// }

function showModalRegisterBook(livro){
    Swal.fire({
    title: 'Registrar exemplares',
    // html: '<input type="text" class="swal2-input" id="codeBar" autofocus/><a href="barcode" target="_blank">asdas</a>',
    html: $('<div>').append(
        $('<input>', {class: 'swal2-input', type: 'text', id: 'codeBar', autofocus: 'autofocus'}).css('margin-bottom', 0),
        $('<a>', {href:'barcode', target: '_blank', text: 'Gerar codigos'}).css('float', 'left')
    ),
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
            register($('#codeBar').val(), livro);
            
        })
        $('#codeBar').keydown(function (event) {
            if (event.keyCode == 13) {
                registerBook($('#codeBar').val(), livro);
                event.preventDefault();
                return false;
            }
        });
    }});
}

function registerBook(code, livro){
    // TODO: Validação do codigo de barra
    if(!code) {
        return;
    }
    $.ajax({
        method: "post",
        url: "/api/exemplar/" + code + '/editar',
        dataType: "json",
        data: {
            'livro': livro
        }
    }).done(function (e) {
        console.log(e);
        $('#codeBar').val('');
        if (e.status) {
            toastr.success('Registrado com sucesso!');
            var estoque = $('#livro' + e.exemplar.livro.id + ' .estoque');
            estoque.html((estoque.html() / 1) + 1)
            var estoqueDisponivel = $('#livro' + e.exemplar.livro.id + ' .estoque-disponivel');
            estoqueDisponivel.html((estoqueDisponivel.html() / 1) + 1)
        } else {
            if (e.error) {
                toastr.warning(e.error);
            } else {
                toastr.warning('Ocorreu um erro ao registrar!');
            }  
        }
    });
}