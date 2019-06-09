$(document).ready(function (){
    $("#form").validate({
        errorClass: "is-invalid text-danger",
        validClass: "is-valid",
        label: "h2",
        rules: {
            matricula:{
                required:true
            },
            email:{
                required: true,
                email: true
            },
            isbm:{
                required:true
            },
            nome:{
                required: true
                
            },
            volume:{
                required: true
            },
            autor:{
                required: true
            },
            abreviacao:{
                required: true
            },
            quantidade:{
                required: true
            }
        },
    })
});

