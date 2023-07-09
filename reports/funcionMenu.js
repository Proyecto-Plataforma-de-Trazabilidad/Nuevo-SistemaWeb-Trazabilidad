$(document).ready(function () {

    // primero tomar el valor del data set opcion

    // al tener el valor entrar al switch 

    // y en la opcion del switch llamar por ajax a las consultas 

    // ya que rregrese los valores crear una funcion de generar grafica 

    //obtener elementos de menu
    var divOpcion = $(".menu-item");
    console.log(divOpcion);

    //evento cuando den clic en alguna opcion 
    divOpcion.click(function() {        
        
        var opcion= $(this).data("opcionreporte");
        var url = "reports/ReporteGrafica.php"
        //var url = $(this).data("url"); TOMAR EL VALOR SI LA RUTA VIENE DESDE EL HTML
        console.log("valor del data: "+opcion+ " valor del url: "+url);   

        // mandar el valor al otro html por ruta
        // var ruta = url +"?opcion=" +encodeURIComponent(opcion);
        // window.location.href=ruta;

        //mandar el valor a otro html por almacenamiento 
        sessionStorage.setItem("opcion",opcion);
        //dirigir a html
        window.location.href= url;
    });




});