
$(document).ready(function () {

    $.ajax({
        url: 'PruebaReportesNay/metodoReporte1.php',
        type: 'POST',
        data: { "tipo": "combo1" },
        success: function (response) {
            $('#inprod').html(response);
        }
    });



    $('#consu').click(function (e) {
        e.preventDefault();

        let prod = document.getElementById("inprod").value;
        let tipofuncion = "registrar";

        var combo = document.getElementById("inprod");
        var selected = combo.options[combo.selectedIndex].text;//nombre productor

        console.log(prod);//id
        console.log(tipofuncion);//opcion

        let parametros = { "inprod": prod, "tipo": tipofuncion }

        console.log(parametros);//parametros
        $.ajax({
            url: 'PruebaReportesNay/metodoReporte1.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response);//ver respuesta servidor
                let array = JSON.parse(response);//convertir a json
                let dat;
                let enteros = [];

                for (var i in array) {
                    dat = (array[i].TotalPiezas);//extraer valores del json
                    if (dat == null)//si la suma es 0 para que no marque error
                    {
                        let n = 0;
                        console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        enteros.push(n);
                    }
                    else {
                        let n = parseInt(dat);
                        console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        enteros.push(n);
                    }
                }

                let etiquetapie = [];//la grafica solo recibe arreglos de etiquetas o de datos 
                etiquetapie.push("Productor " + selected);//indicando que la etiqueta sera el productor y su nombre
                console.log(etiquetapie);

                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) {//si ya existe destruyelo, si no no entra
                    chartStatus.destroy();
                }

                var graphTarget = $("#myChart");//asigno ala grafica 

                //aqui todo lo dela grafica config
                var chartdata = {
                    labels: etiquetapie,
                    datasets: [
                        {
                            label: 'Piezas',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: enteros,
                            fillText: enteros,
                        }
                    ]
                };

                var barGraph = new Chart(graphTarget, {//asigancion de datos y tipo grafica
                    type: 'bar',
                    data: chartdata,
                    onAnimationComplete: function () {
                        this.fillText(this.datasets[0].bars, true);
                    },
                    options: {
                        responsive: true, // Hace que el gráfico sea responsivo al tamaño del contenedor
                        maintainAspectRatio: false, // Permite cambiar la relación de aspecto del gráfico
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });


            }
        });
        $('#frm').trigger('reset');
    });

    /*  window.addEventListener('resize', function(event){
          $('#tabla').DataTable().fnDestroy();
          $('#tabla').DataTable({
              scrollX:true,
          });
      },true);
  */


});