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

