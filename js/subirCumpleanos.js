/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
