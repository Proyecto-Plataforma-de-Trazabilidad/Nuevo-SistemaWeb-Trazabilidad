$(document).ready(function () {

    var opcion = sessionStorage.getItem("opcion");
    // comprobar valor
    console.log("la opcion recibida es: " + opcion);

    var opcionEntero = parseInt(opcion);

    // tomar valor del elemento titulo
    var texto = document.getElementById("texto");


    // validacion switch para generar los graficos
    switch (opcionEntero) { // Reporte Envases mas ordenados 1
        case 1:
            var titulo = "Reporte Envases mas ordenados";
            texto.innerText = titulo; //escribir titulo de reporte
            //ajax para graficar              
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica, tipoGrafica
                consulta(opcionEntero, 'TipoEnvase', 'Tipo de Envase', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                const canvas = document.getElementById("myChart");
                //funcion pdf
                generaPdf(titulo);
            });

            break;

        // Reporte de distribuidores más concurridos 2
        case 2:
            var titulo = "Reporte de distribuidores más concurridos";
            texto.innerText = titulo; // escribir titulo de reporte
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre Distribuidor', 'doughnut');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        // Reporte de contenedores más concurridos 3
        case 3:
            var titulo = "Reporte de contenedores más concurridos";
            texto.innerText = titulo; //escribir titulo de reporte            
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Contenedor', 'Numero y Origen de Contenedor', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        // Reporte de productores con más ordenes 4
        case 4:
            var titulo = "Reporte de productores con más ordenes";
            texto.innerText = titulo; //escribir titulo de reporte            
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre Productor', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        // Reporte de municipios con menos entregas 5
        case 5:
            var titulo = "Reporte de municipios con menos entregas";
            texto.innerText = titulo; //escribir titulo de reporte            
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre de municipio', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        // Reporte de distribuidores con menos entregas 6
        case 6:
            var titulo = "Reporte de distribuidores con menos entregas";
            texto.innerText = titulo; //escribir titulo de reporte          
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre de distribuidor', 'pie');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;
        // Reporte de contenedores con menos salidas 7
        case 7:
            var titulo = "Reporte de contenedores con menos salidas";
            texto.innerText = titulo; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Contenedor', 'Nombre de contenedor', 'pie');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;
        case 8:
            var titulo = "Todas las entregas por productor";
            texto.innerText = titulo;
            // escribir titulo de reporte
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'P.Nombre', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                // funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        case 9:
            var titulo = "Todos los Extraviados por Productor";
            texto.innerText = titulo;
            // escribir titulo de reporte
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'P.Nombre', 'bar');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                // funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        case 10:
            var titulo = "Total Ordenes por Productor";
            texto.innerText = titulo;
            // escribir titulo de reporte
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'P.Nombre', 'pie');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                // funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

            case 11:
            var titulo = "Total Entregas por Distribuidor";
            texto.innerText = titulo;
            // escribir titulo de reporte
            // ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Distribuidor', 'pie');
                activaPdf();
            });

            // generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                // funcion csv
                generaCSV(opcionEntero, titulo);
            });

            //generar PDF
            $('#pdf').click(function (e) {
                e.preventDefault();
                //funcion pdf
                generaPdf(titulo);
            });
            break;

        default:
            console.log("Opcion no valida");
            break;
    } // fin switch


    function consulta(opc, col1, titulo1, grafica) {
        let parametros = {
            "opcion": opc
        }
        // console.log(parametros);//parametros
        $.ajax({
            url: 'Reportes.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response); // ver respuesta servidor
                let array = JSON.parse(response);
                // convertir a json
                // console.log(array);
                // let dat;
                // let enteros = [];

                var cant = [];
                var tipo = [];

                for (var i in array) { // tomar la cantidad
                    dat = (array[i].Total); // extraer valores del json
                    if (dat == null) { // si la suma es 0 para que no marque error
                        let n = 0;
                        // console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    } else {
                        let n = parseInt(dat);
                        // console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    }

                    var dat = array[i][col1]; // extraer valores del json
                    console.log(dat);
                    // la grafica solo recibe arreglos de etiquetas o de datos
                    tipo.push(titulo1 + ": " + dat); // indicando que la etiqueta sera el productor y su nombre
                    console.log(tipo);
                }
                
                // subtitulos, datos, tipoGrafica
              graficar(tipo, cant, grafica); // Generar grafica
               
                

            }
        });
        $('#frm').trigger('reset');

    };


    function graficar(label, data, tipo,) {
        let chartStatus = Chart.getChart("myChart"); // <canvas> id
       
        if (chartStatus != undefined) { // si ya existe destruyelo, si no no entra
            chartStatus.destroy();
        }

       
        var chartdata = {
            labels: label,
            datasets: [
                {
                    label: 'Piezas',
                    backgroundColor: [
                        '#8C7472',
                        '#D9A9A5',
                        '#D4D9BA',
                        '#A5BDD9',
                        '#878C6B',
                    ],
                    borderColor: [
                        '#8C7472',
                        '#D9A9A5',
                        '#D4D9BA',
                        '#A5BDD9',
                        '#878C6B',
                    ],
                    hoverBackgroundColor: '#3C7335',
                    hoverBorderColor: '#000000',
                    data: data
                }
            ]
        };

        const bgColor={
            id:'bgColor',
            beforeDraw:(chart,steps,options)=>{
                const{ctx}=chart;
                ctx.fillStyle=options.backgroundColor;
                ctx.fillRect(0,0,1500,1100);
                ctx.restore();
            }
        }

        var barGraph = new Chart(document.getElementById("myChart"),{ // asigancion de datos y tipo grafica
            type: tipo,
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
                },
                plugins:{
                    bgColor:{
                        backgroundColor:'white'
                    }
                }
            },
            plugins:[bgColor]
        });   
       
  
       
    };
    

    function generaCSV(opc, titulo) {
        let nombre = titulo.replace(/\s/g, "");  //quitar espacios del titulo   
        let parametros = { "opcion": opc }
        //console.log(parametros);//parametros
        $.ajax({
            url: 'Reportes.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response); // ver respuesta servidor
                let array = JSON.parse(response); // convertir a json
                console.log(array);

                // generar archivo csv
                var csv = Papa.unparse(array, { // delimiter: ";", // Delimitador personalizado
                    header: true, // Incluir encabezados
                    newline: "\n", // Salto de línea personalizado
                    quoteChar: '"', // Carácter de cita personalizado
                    encoding: "utf-8" // Codificación del archivo CSV
                });
                var csvData = '\ufeff' + csv;
                // Añadir el BOM (Byte Order Mark) para especificar UTF-8
                // console.log(csv);
                var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                var url = URL.createObjectURL(blob);
                var link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', nombre + '.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    };

    function activaPdf() {
        let btnPdf = document.getElementById("pdf");
        btnPdf.disabled = false;
    };
   
    
    function generaPdf(titulo) {
        let nombre = titulo.replace(/\s/g, "");  //quitar espacios del titulo  
        const canvas = document.getElementById("myChart");

        const canvasImage = canvas.toDataURL("image/jpeg",1.0);       
        
        console.log("imagen", canvasImage); //La imagen esta codificada en base64 
        let formData = new FormData(); //Esta funcion normalmente se usa en formularios para guardar informacion
        formData.append('img', canvasImage); //Se agrega la imagen que se genero al objeto formdata con el identificador 'img'
      

        $.ajax({
            url: 'diseñoPdf.php', //Archivo que genera la imagen
            data: formData, //el objeto que contiene la imagen 
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            xhrFields: { responseType: 'blob' }, //Esta configuracion permite recibir contenido tipo blob(la codificacion que usa pdf)
            success: function (response) {
                console.log(response);
                var blob = new Blob([response], { type: 'application/pdf' });
                var file = new File([blob], nombre + '.pdf');
                var link = document.createElement('a');
                link.href = URL.createObjectURL(file);
                link.download = file.name;
                link.click();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo registrar por error',
                    text: thrownError,
                });
            }
        });


    };

});
