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



$(document).ready(function () {
    separadorOnOff(true);
});

function separadorOnOff(activar) {
    //console.log("timer separador");
    if (activar) {
        $("#separador").fadeIn(iniciar());
        
    } else {
        //SI NO HAY CONTENIDO NO SACO EL SEPARADOR
        if (duracionSlide != null && duracionSlide.length != 0) {
            setTimeout(function () {
                iniciarSwiper();
                $("#separador").fadeOut();

                //console.log("fin timer separador");
            }, 15000);
        } else {
            setTimeout(function () {
                iniciar();

                //console.log("fin timer separador");
            }, 15000);
        }
    }
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
        url: 'ws/listaPublicadaWS.php',
        type: 'POST',
        success: function (response) {
            actualizarContenido(JSON.parse(response));
            separadorOnOff(false);

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
    $("#main").css('background-color', '#006633');
    for (var i = 0; i < json.pantallas.length; i++) {
        switch (json.pantallas[i].id_tipos)
        {
            case '1':
                //  TEXTO
                div = document.createElement('div');
                div2 = document.createElement('div');
                h1 = document.createElement("h1");

                $(div).addClass("swiper-slide");
                $(div).css('background-image', 'url(' + fondoCategoria(json, json.pantallas[i].id_categorias) + ')');
 
                $(div2).css('display', 'table-cell');
                $(div2).css('height', '1080px');
                $(div2).css('width', '1920px');
                $(div2).css('padding', '0');
                $(div2).css('margin', '0');
                $(div2).css('text-align', 'center');
                $(div2).css('vertical-align', 'middle');

                $(h1).html(json.pantallas[i].texto1);
                $(h1).css('color', 'white');

                $(h1).appendTo($(div2));
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
                div2 = document.createElement('div');

                $(div).addClass("swiper-slide");

                $(div2).css('background-image', 'url(' + json.pantallas[i].url_imagen + ')');
                $(div2).css('height', '1080px');
                $(div2).css('width', '1920px');
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
                div2 = document.createElement('div');
                iframe = document.createElement('iframe');

                $(div).addClass("swiper-slide");

                $(div2).css('height', '1080px');
                $(div2).css('width', '1920px');
                $(div2).css('padding', '0');
                $(div2).css('margin', '0');

                $(iframe).css('height', '1080px');
                $(iframe).css('width', '1920px');
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
    if (con < duracionSlide.length - 1) {
        //QUEDAN ELEMENTOS EN COLA
        if (duracionSlide[con][0] == 0) {
            //VIDEO
            player = new Vimeo.Player(duracionSlide[con][1]);
            player.setVolume(0);
            player.on('ended', function () {
                mySwiper.slideNext();
            });
            player.play();
        } else {
            //NO ES VIDEO
            console.log(duracionSlide[con].toString());
            timer = setTimeout(function () {
                console.log("timer");
                mySwiper.slideNext();
            }, duracionMilisegundos(duracionSlide[con][0]));
        }
        con++;

    } else {
        //ULTIMO ELEMENTO
        if (duracionSlide[con][0] == 0) {
            //VIDEO
            player = new Vimeo.Player(duracionSlide[con][1]);
            player.setVolume(0);
            player.on('ended', function () {
                separadorOnOff(true);
            });
            player.play();
        } else {
            //NO ES VIDEO
            console.log(duracionSlide[con].toString());
            timer = setTimeout(function () {
                console.log("timer");

                separadorOnOff(true);
            }, duracionMilisegundos(duracionSlide[con][0]));
        }
        con++;

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

