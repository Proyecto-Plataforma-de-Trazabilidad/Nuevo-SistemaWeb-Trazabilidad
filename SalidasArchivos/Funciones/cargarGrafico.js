$(document).ready(function () {

    //Funcion para generar el grafico
    $('#Contenedor').on('change', function () {

        let idContenedor = this.value;

        $.ajax({
            url: 'EntregasArchivos/datosGrafico.php',
            data: { "idContenedor": idContenedor },
            type: 'POST',
            success: function (response) {
                let datos = JSON.parse(response);//Trae los datos en formato json y los pasa a objeto
                //console.log(datos);
                let Capacidad = [(datos.Capacidad - datos.Status)];
                let Status = [datos.Status];
                CapacidadTotalConten = datos.Capacidad;
                CapacidadConten = Capacidad[0];
                StatusConten = Status[0];

                let graphTarget = $("#myChart");//asigno ala grafica 

                //Borra la grafica si ya existe
                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) { // si ya existe destruyelo, si no no entra
                    chartStatus.destroy();
                }

                //aqui todo lo dela grafica config
                let chartdata = {
                    labels: idContenedor,
                    datasets: [
                        {
                            label: 'Status',
                            backgroundColor: '#0cb220',
                            borderColor: '#0ea320',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: Status,
                            fill: false,
                        },
                        {
                            label: 'Capacidad',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: Capacidad,
                            fill: false,
                        },
                    ]
                };

                let barGraph = new Chart(graphTarget, {//asigancion de datos y tipo grafica
                    type: 'bar',
                    data: chartdata,
                    // onAnimationComplete: function () {
                    //     this.fillText(this.datasets[0].bars, true);
                    // },
                    options: {
                        indexAxis: 'y',
                        responsive: true, // Hace que el gráfico sea responsivo al tamaño del contenedor
                        maintainAspectRatio: false, // Permite cambiar la relación de aspecto del gráfico
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            title: {
                                display: true,
                                text: `Contenedor ${idContenedor}`
                            }
                        }
                    }
                });

            }
        });
    });

})