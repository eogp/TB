/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// A $( document ).ready() block.
$(document).ready(function () {
    heightMap();
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

function subir(id) {
    $.ajax({
        data: {subir: id},
        url: 'ws/ordenListaWS.php',
        type: 'POST',
        success: function (response) {
            //alert(response);
            if (response == '1') {
                location.reload();

            }
        },
        error: function () {
            alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
        }
    });


}
function bajar(id) {
    $.ajax({
        data: {bajar: id},
        url: 'ws/ordenListaWS.php',
        type: 'POST',
        success: function (response) {
            //alert(response);
            if (response == 1) {
                location.reload();

            }
        },
        error: function () {
            alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
        }
    });
}
function quitar(id) {
    var opcion = confirm("¿Desea quitar este elemendo de la lista?");
    if (opcion) {
        $.ajax({
            data: {quitar: id},
            url: 'ws/ordenListaWS.php',
            type: 'POST',
            success: function (response) {
                //alert(response);
                if (response == 1) {
                    location.reload();

                }
            },
            error: function () {
                alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
            }
        });
    }
}