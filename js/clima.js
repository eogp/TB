/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function ()
{
    jQuery.displayDateTime(("#hora"),("#fecha"));
    climaCampana();
    climaBsAS();

    //900000 => 15 minutos
    setInterval(function () {
        climaCampana();
        climaBsAS();

    }, 900000);

});

function climaCampana() {
    var city = "Campana, buenos aires";
    var searchtext = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='" + city + "') and u='c'"
    $.getJSON("https://query.yahooapis.com/v1/public/yql?q=" + searchtext + "&format=json&lang=es-ES").then(function (data)
    {
        var result = data.query.results.channel;
        var location = result.location;
        var item = result.item;
        var condition = item.condition;
        var units = result.units;
        var wind = result.wind;

//        $('.panel-heading')
//                .html('<h4 class="text-center">' + location.country + ', ' + location.region + ', ' + location.city + '</h4>');
//        $('.panel-body')
//                .find('img')
//                .attr('src', 'https://s.yimg.com/zz/combo?a/i/us/nws/weather/gr/' + condition.code + 'd.png')
//                .after('<h2>' + condition.temp + 'º' + units.temperature + ', ' + condition.text + ', ' + wind.speed + ' ' + units.speed + '</span>');
        $("#tempCampana").text(condition.temp + 'º' + units.temperature);
        $("#imgCampana").attr('src', 'https://s.yimg.com/zz/combo?a/i/us/nws/weather/gr/' + condition.code + 'd.png')
        
    });
}

function climaBsAS() {
    var city = "buenos aires";
    var searchtext = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='" + city + "') and u='c'"
    $.getJSON("https://query.yahooapis.com/v1/public/yql?q=" + searchtext + "&format=json&lang=es-ES").then(function (data)
    {
        var result = data.query.results.channel;
        var location = result.location;
        var item = result.item;
        var condition = item.condition;
        var units = result.units;
        var wind = result.wind;

//        $('.panel-heading')
//                .html('<h4 class="text-center">' + location.country + ', ' + location.region + ', ' + location.city + '</h4>')
//        $('.panel-body')
//                .find('img')
//                .attr('src', 'https://s.yimg.com/zz/combo?a/i/us/nws/weather/gr/' + condition.code + 'd.png')
//                .after('<h2>' + condition.temp + 'º' + units.temperature + ', ' + condition.text + ', ' + wind.speed + ' ' + units.speed + '</span>')
        $("#tempBsAs").text(condition.temp + 'º' + units.temperature);
        $("#imgBsAs").attr('src', 'https://s.yimg.com/zz/combo?a/i/us/nws/weather/gr/' + condition.code + 'd.png')


    });
}

jQuery.displayDateTime = function (wraperHora, wraperFecha) {
    var now = new Date();
    var months = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    var days = new Array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');

    var date = now.getDate();
    var year = now.getFullYear();
    var month = now.getMonth();
    var day = now.getDay();

    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();

    hour = (hour < 10) ? "0" + hour : hour;
    minute = (minute < 10) ? "0" + minute : minute;
    second = (second < 10) ? "0" + second : second;

    var hora=  hour + ':' + minute + ' hs';
    var fecha = days[day] + ' ' + date +'  de ' + months[month] +  ' de ' + year ;
    
    $(wraperHora).text(hora);
    $(wraperFecha).text(fecha);

    setTimeout('jQuery.displayDateTime("' + wraperHora +'","'+ wraperFecha + '");', '1000');
}