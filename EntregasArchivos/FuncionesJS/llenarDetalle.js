$(document).ready(function () {
  let numDetalle = document.getElementById("numDetalle");
  let i = 1;
  let CapacidadConten = 0, CapacidadTotalConten = 0, StatusConten = 0;
  let piezasProductor = 0;

  //Mensaje de advertising
  function mensajeAdvertencia(titulo, texto) {
    Swal.fire({
      icon: 'warning',
      title: titulo,
      text: texto,
      showConfirmButton: false,
      timer: 1800
    });
  }

  //Si se selacciona un elemento de la combo de tipo envace se marca como valida
  $('#tipoEnva').on('change', function () {
    $('#tipoEnva').get(0).setCustomValidity('');
  });

  //Funcion ara traer las piezas que ordeno el productor
  $('#nomProdu').on('change', function () {

    $('#nomProdu').get(0).setCustomValidity('');//Si se selecciono un elemento ya pone la combo como valida

    let idProductor = this.value;
    $.ajax({
      url: 'EntregasArchivos/Peticiones/obtenerDatosGrafico.php',
      data: { "idProductor": idProductor },
      type: 'POST',
      success: function (response) {
        let datos = JSON.parse(response);//Trae los datos en formato json y los pasa a objeto
        //console.log(datos);
        piezasProductor = datos.TotalPiezasOrden - datos.TotalPiezasEntregadas;
        console.log(piezasProductor);

        if ($('#mostrarPiezas').text()) {
          $('#mostrarPiezas').remove();
        }
        //Muestra las piezas que tiene el productor
        $('#frmEntrega div:last').after(`<div id="mostrarPiezas" class="col-sm-4">
        <label class="form-label">Piezas del productor: </label>
        <label id="piezasProductor" class="form-label"> ${piezasProductor}</label>
        </div>`);


        if (piezasProductor <= 0) {
          $('#aceptar').prop("disabled", true); //Desactiva el detalle para q o registre
          Swal.fire({
            icon: 'warning',
            title: 'El productor no cuenta con piezas',
            text: 'El productor ya entrego todas las piezas que ordeno',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }

    });
  });


  //Funcion para generar el grafico
  $('#contene').on('change', function () {

    $('#contene').get(0).setCustomValidity('');

    let idContenedor = this.value;

    $.ajax({
      url: 'EntregasArchivos/Peticiones/obtenerDatosGrafico.php',
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

  //Funcion para actualizar el grafico

  function actualizaGrafico(Capacidad, Status) {

    let capacidad = [Capacidad];
    let status = [Status];

    let chartStatus = Chart.getChart("myChart"); // <canvas> id
    //console.log(chartStatus.data);

    //Borro la barra actual
    chartStatus.data.datasets.forEach((dataset) => {
      dataset.data.pop();
    });
    chartStatus.update();

    //Se añade la nueva barra
    chartStatus.data.datasets[0].data.push(status);
    chartStatus.data.datasets[1].data.push(capacidad);

    chartStatus.update();
  }


  //Funcion que llena la tabla
  $('#aceptar').click(function () {

    if (!$('#contene')[0].checkValidity()) {
      mensajeAdvertencia('No a seleccionado un contenedor', '');
    } else if (!$('#nomProdu')[0].checkValidity()) {
      mensajeAdvertencia('No a seleccionado un productor', '');

    } else { //Hace el resto
      let valEnvase = document.getElementById("tipoEnva").value;
      let valPiezas = document.getElementById("cantiPza").value;
      let valPeso = document.getElementById("peso").value;
      let valObser = document.getElementById("observa").value;

      $('#contene').prop("disabled", true); //Se desactiva la combo para que no alteren la grafica
      $('#nomProdu').prop("disabled", true); //Se desactiva la combo para que no alteren el conteo de piezas

      //Se llena la grafica coon las piezas
      let nuevoStatus = parseInt(valPiezas) + parseInt(StatusConten);
      if (nuevoStatus > CapacidadTotalConten) {
        mensajeAdvertencia('Capacidad Maxima', 'Sobrepaso la capacidad del contenedor');
      } else if (valPiezas > piezasProductor) {

        mensajeAdvertencia('Intente con otra cantidad', 'El productor ya no cuenta con piezas ordenadas');
      } else {
        let fila = '<tr id="row' + i + '"> <td>' + i + '</td> <td>' + valEnvase + '</td> <td>' + valPiezas + '</td> <td>' + valPeso + '</td> <td>' + valObser + '</td> <td><button style="background-color: #dc3545 !important" type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';

        i++;

        numDetalle.textContent = "Detalle de entrega: 00" + i;

        $('#detalle tbody:first').before(fila);
        document.getElementById("tipoEnva").value = "";
        document.getElementById("cantiPza").value = "";
        document.getElementById("peso").value = "";
        document.getElementById("observa").value = "";

        StatusConten = parseInt(StatusConten) + parseInt(valPiezas);
        CapacidadConten = CapacidadConten - valPiezas;
        piezasProductor = piezasProductor - valPiezas;

        console.log("Capacidad: " + CapacidadConten);
        console.log("Status: " + StatusConten);
        console.log("Piezas del productor: " + piezasProductor);

        $('#piezasProductor').text(piezasProductor); //Cambia el numero de piezas que se va a mostrar

        actualizaGrafico(CapacidadConten, StatusConten);
      }
    }


  });

  //Funcion para borrar un elemento de la tabla 
  $(document).on('click', '.btn_remove', function () {
    Swal.fire({
      title: 'Desea borrar el elemento?',
      text: "Esta acción no se puede revertir",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar!'
    }).then((result) => {
      if (result.isConfirmed) {
        //Selecciona el id de la fila
        var button_id = $(this).attr("id");

        //Decrementa la grafica
        //!Id de la fila.         busca dentro de la fila la etiqueta td numero 3(contine la cantidad de piezas ). toma el texto que contiene la etiqueta
        let cantidadPza = $('#row' + button_id + '').find("td:nth-child(3)").text();
        StatusConten = parseInt(StatusConten) - parseInt(cantidadPza);
        CapacidadConten = parseInt(CapacidadConten) + parseInt(cantidadPza);
        piezasProductor = parseInt(piezasProductor) + parseInt(cantidadPza);

        console.log("Capacidad: " + CapacidadConten);
        console.log("Status: " + StatusConten);
        console.log("Piezas del productor: " + piezasProductor);

        $('#piezasProductor').text(piezasProductor); //Cambia el numero de piezas que se va a mostrar

        actualizaGrafico(CapacidadConten, StatusConten);

        //Elimina la fila
        $('#row' + button_id + '').remove();
        //Recalcular indices
        i--;
        numDetalle.textContent = "Detalle de entrega: 00" + i;
        let container = document.querySelector('#detalle');
        let celdasId = container.querySelectorAll('tr'); //Selecciona todos los contenedores tr de la tabla

        if (celdasId.length > 1) {
          for (let i = 1; i < celdasId.length; i++) {
            celdasId[i].id = "row" + i;   //Cambia el id de la fila
            celdasId[i].childNodes[1].textContent = i;      //Coloca la numeración en la primera columna
            celdasId[i].lastChild.childNodes[0].id = i;     //Reasigna la id del botón que elimina
          }
        }

        if (celdasId.length == 1) {
          $('#contene').prop("disabled", false); //Se vuelve a a activar la combo ya que no hay registros en el detalle
          $('#nomProdu').prop("disabled", false); //Se vuelve a a activar la combo ya que no hay registros en el detalle
        }
        Swal.fire(
          'Borrado!',
          'El elemento se borro correctamente.',
          'success'
        )
      }
    })
  });

});