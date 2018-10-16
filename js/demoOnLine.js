/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var mySwiper;
var player;
var duracionSlide = [];
var con = 0;
var timer;

// A $( document ).ready() block.
$(document).ready(function () {
    heightAuto();
    iniciar();
});

//ajusta la aultura del div menu y el rpincipal
function heightAuto() {
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


function iniciar() {
    //console.log("iniciar");
    if (mySwiper != null)
        mySwiper.destroy(true, true);
    player = null;
    duracionSlide = [];
    con = 0;
    timer = null;

    $.ajax({
        data: {pantalla: 1},
        url: 'ws/listaActivaWS.php',
        type: 'POST',
        success: function (response) {
            actualizarContenido(JSON.parse(response));
            iniciarSwiper();
            //console.log("fin ajax");

        },
        error: function () {
            alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
        }
    });
    //console.log("fin iniciar");
}

function actualizarContenido(json) {
    //console.log("actualizarContenido");
    $("#main").empty();
    for (var i = 0; i < json.pantallas.length; i++) {
        switch (json.pantallas[i].id_tipos)
        {
            case '1':
                //  TEXTO
                div = document.createElement('div');
                div2 = document.createElement('div');
                textarea = document.createElement("textarea");

                $(div).addClass("swiper-slide");

                $(div).css('background-image', 'url(' + fondoCategoria(json, json.pantallas[i].id_categorias) + ')');
                $(div).css('background-size', '1280px 720px');
                $(div2).css('background-size', '1280px 720px');
                $(div2).css('display', 'table-cell');
                $(div2).css('height', '720px');
                $(div2).css('width', '1280px');
                $(div2).css('padding', '0');
                $(div2).css('margin', '0');
                $(div2).css('text-align', 'center');
                $(div2).css('vertical-align', 'middle');

                 $(textarea).html(json.pantallas[i].texto1);
                $(textarea).attr('cols' , '33');
                $(textarea).attr('rows' , '5');
                $(textarea).css('color', 'white');
                $(textarea).css('background-color', 'transparent');
                $(textarea).css('border', 'none');
                $(textarea).css('resize', 'none');
                $(textarea).css( 'font-size', '60px' );

                $(textarea).appendTo($(div2));
                $(div2).appendTo($(div));
                $(div).appendTo($("#main"));

                var tiempoTexto = [];
                tiempoTexto.push(json.pantallas[i].duracion);
                tiempoTexto.push($(div2));
                duracionSlide.push(tiempoTexto);
                break;
            case '2':
                //  IMAGEN
                div = document.createElement('div');
                $(div).addClass("swiper-slide");

                div2 = document.createElement('div');

                $(div2).css('background-image', 'url(' + json.pantallas[i].url_imagen + ')');
                $(div2).css('background-size', '1280px 720px');
                $(div2).css('height', '720px');
                $(div2).css('width', '1280px');
                $(div2).css('padding', '0');
                $(div2).css('margin', '0');

                $(div2).appendTo($(div));
                $(div).appendTo($("#main"));

                var tiempoImagen = [];
                tiempoImagen.push(json.pantallas[i].duracion);
                tiempoImagen.push($(div2));
                duracionSlide.push(tiempoImagen);
                break;
            case '3':
                //  VIDEO
                div = document.createElement('div');
                iframe = document.createElement('iframe');
                $(div).addClass("swiper-slide");

                div2 = document.createElement('div');

                $(div2).css('height', '720px');
                $(div2).css('width', '1280px');
                $(div2).css('padding', '0');
                $(div2).css('margin', '0');

                $(iframe).css('height', '720px');
                $(iframe).css('width', '1280px');
                $(iframe).css('padding', '0');
                $(iframe).css('margin', '0');
                $(iframe).css('background-color', 'black');
                $(iframe).attr('src', '' + json.pantallas[i].url_vimeo);

                $(iframe).appendTo($(div2));
                $(div2).appendTo($(div));
                $(div).appendTo($("#main"));

                var tiempoVideo = [];
                tiempoVideo.push(0);
                tiempoVideo.push($(iframe));
                duracionSlide.push(tiempoVideo);
                break;
        }
    }
    //console.log("fin actualizarContenido");

}

function fondoCategoria(json, id) {
    //console.log("fondoCategoria");
    var retorno;
    for (var i = 0; i < json.categorias.length; i++) {
        if (json.categorias[i].id == id) {
            retorno = json.categorias[i].url_img_fondo;
        }
    }
    //console.log("fin fondoCategoria");
    return retorno;
}

function iniciarSwiper() {
    //console.log("iniciarSwiper");
    mySwiper = new Swiper('.swiper-container', {
        speed: 2000,
        spaceBetween: 100,
        effect: 'cube',
        init: false,
        stopOnLastSlide: true,
        on: {
            init: function () {
                tiempos();
                //console.log('swiper initialized');
            },
            slideChange: function () {
                tiempos();
                //console.log('swiper changes');
            }
        }
    });
    mySwiper.init();
    //console.log("fin iniciarSwiper");
}

function tiempos() {
    //console.log("tiempos");
    if (duracionSlide != null && duracionSlide.length != 0) {
        //SOLO EJECUTO EL SWIPER SI HAY CONTENIDO
        if (con < duracionSlide.length - 1) {
            //EXISTEN MAS ELEMENTOS EN COLA
            if (duracionSlide[con][0] == 0) {
                // ES VIDEO
                player = new Vimeo.Player(duracionSlide[con][1]);
                player.setVolume(0);
                player.on('ended', function () {
                    mySwiper.slideNext();
                });
                player.play();
            } else {
                //NO ES VIDEO
                //console.log(duracionSlide[con].toString());
                timer = setTimeout(function () {
                    //console.log("timer");
                    mySwiper.slideNext();
                }, duracionMilisegundos(duracionSlide[con][0]));
            }
            con++;
        } else {
            //ES EL ULTIMO ELEMENTO
            if (duracionSlide[con][0] == 0) {
                //ES VIDEO
                player = new Vimeo.Player(duracionSlide[con][1]);
                player.setVolume(0);
                player.on('ended', function () {
                    //iniciar();
                });
                player.play();
            } else {
                //NO ES VIDEO
                console.log(duracionSlide[con].toString());
                timer = setTimeout(function () {
                    //console.log("timer");
                    //iniciar();
                }, duracionMilisegundos(duracionSlide[con][0]));
            }
            con++;
            //console.log("fin tiempos");
        }
    } else {
        alert("No existen contenidos en la lista activa.");
    }

}

function duracionMilisegundos(duracion) {
    //console.log("duracionMilisegundos");
    var aux = duracion.toString().split(":");
    var retorno = 0;
    for (var i = 0; i < aux.length; i++) {
        if (i == 0) {
            retorno = retorno + aux[i] * 60 * 1000;
        } else {
            retorno = retorno + aux[i] * 1000;
        }

    }
    //console.log("duracionMilisegundos " + retorno);
    //console.log("fin duracionMilisegundos");
    return retorno;
}

function publicar() {
    var opcion = confirm("¿Desea actualizar la publicación actual?");
    if (opcion) {
        $.ajax({
            data: {publicar: 1},
            url: 'ws/publicarlistaActivaWS.php',
            type: 'POST',
            success: function (response) {
                if (response.toString() == '1') {
                    alert("La publicación se actualizo con exito!");
                } else {
                    alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
                }
            },
            error: function () {
                alert("Ocurrió un error al conectar con el servidor. Verifique su conexión a internet.");
            }
        });
    }
}