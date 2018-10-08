/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



// A $( document ).ready() block.
$(document).ready(function () {
    heightMap();
    //CONTENIDOS POR CATEGORIA DE TIPO--------------------
    document.getElementById('select-tipo').addEventListener('change', function () {
        contenidoPorTipo(this.value);
    });
    $('form').submit(function (e) {
        if (!valCampos()) {
            e.preventDefault();
            console.log($("#select-categoria").val());

            alert("Debe completar todos los campos");
        }
    });
    
    $("#selec-sesion").change(function (){
       if($('#selec-sesion').val()=='cerrarSesion'){
           location.href = 'controlers/cerrarControler.php';
       };
    });
});

//ajusta la aultura del div menu y el rpincipal
function heightMap() {

    //console.log($(window).height());

    // set initial div height / width
    document.getElementById('principal').style.height = "" + $(window).height() - 70 + "px";
    document.getElementById('menu').style.height = "" + $(window).height() - 70 + "px";
    // make sure div stays full width/height on resize
    $(window).resize(function () {
        console.log($(window).height());
        document.getElementById('principal').style.height = "" + $(window).height() - 70 + "px";
        document.getElementById('menu').style.height = "" + $(window).height() - 70 + "px";
    });
}

function contenidoPorTipo(valor) {
    switch (valor) {
        case '1':
            //TEXTO
            $('#div-texto').show();
            $('#div-imagen').hide();
            $('#div-duracion').show();
            $('#div-video').hide();
            $('#submit').prop('disabled', false);
            break;
        case '2':
            //IMAGEN
            $('#div-texto').hide();
            $('#div-imagen').show();
            $('#div-duracion').show();
            $('#div-video').hide();
            $('#submit').prop('disabled', false);
            break;
        case '3':
            //VIDEO
            $('#div-texto').hide();
            $('#div-imagen').hide();
            $('#div-duracion').hide();
            $('#div-video').show();
            $('#submit').prop('disabled', false);
            break;
        default:
            $('#div-texto').hide();
            $('#div-imagen').hide();
            $('#div-duracion').hide();
            $('#div-video').hide();
            $('#submit').prop('disabled', true);
            break;
    }
}


function valCampos() {
    switch ($("#select-tipo").val()) {
        case '0':
            return false;
            break;
        case '1':
            return $("#select-categoria").val() != null
                    && $("#select-tipo").val() != null
                    && $("#text-area").val() != ''
                    && $("#min").val() != ''
                    && $("#sec").val() != ''
                    && $("#input-nombre").val() != '';
            break;
        case '2':
            return $("#select-categoria").val() != null
                    && $("#select-tipo").val() != null
                    && $("#image-upload").val() != ''
                    && $("#min").val() != ''
                    && $("#sec").val() != ''
                    && $("#input-nombre").val() != '';
            break;
        case '3':
            return $("#select-categoria").val() != null
                    && $("#select-tipo").val() != null
                    && $("#video").val() != ''
                    && $("#input-nombre").val() != '';

            break;

    }
}

