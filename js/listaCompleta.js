/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//LOADING AJAX------------------------------------------------------------------
$(document).on({
    ajaxStart: function () {
        $("body").addClass("loading");
    },
    ajaxStop: function () {
        $("body").removeClass("loading");
    }
});
//------------------------------------------------------------------------------

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

function editar(pantallaId) {
    $.ajax({
        data: {pantalla_Id: pantallaId},
        url: 'controlers/editarControler.php',
        type: 'POST',
        success: function (response) {
            if (response == "") {
                alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
            } else {
                //alert(response);
                //$(location).attr('href','EditarPantalla.php');
                $(window).attr('location', 'EditarPantalla.php');
            }
        },
        error: function () {
            alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
        }
    });
}

function eliminar(id) {
    var opcion = confirm("¿Desea quitar este elemendo de la lista?");
    if (opcion) {
        $.ajax({
            data: {pantalla: id},
            url: 'ws/eliminarWS.php',
            type: 'POST',
            success: function (response) {
                if (response)
                {
                    location.reload();
                } else
                {
                    alert("No se pudo completar la operación. Por favor reintente.");
                }
            },
            error: function () {
                alert("No se pudo completar la operación. Por favor reintente.");
            }
        });
    }
}

function onOff(id) {

    $.ajax({
        data: {pantalla: id},
        url: 'ws/onOffWS.php',
        type: 'POST',
        success: function (response) {
            if (response)
            {
                location.reload();
            } else
            {
                alert("No se pudo completar la operación. Por favor reintente.");
            }
        },
        error: function () {
            alert("No se pudo completar la operación. Por favor reintente.");
        }
    });
}




