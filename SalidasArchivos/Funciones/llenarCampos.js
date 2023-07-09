//
const numSalida = document.getElementById("numSalida");
const recolector = document.getElementById("recolector");
const Contenedor = document.getElementById("Contenedor");

$.ajax({
    url: 'SalidasArchivos/Peticiones/obtenerCampos.php',
    type: 'POST',
    success: function (res) {

        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto

        //Productor
        if (datos.mensaje != "TodoCorrecto") {
            $('#registrar').prop('disabled', true);
            Swal.fire({
                icon: 'warning',
                title: 'Sucedio algun error',
                text: 'Por favor ingrese con una cuenta de recolector',
                showConfirmButton: false,
                timer: 2000
            });

        } else {
            //recolector
            recolector.placeholder = datos.nomRec; //Ubica al usuario en el input
            recolector.dataset.idRec = "" + datos.idRec; //Asigna el id del distribuidor al dataset
            //numSalida
            numSalida.textContent = "Número de salida: " + datos.numSalidas; //Coloca el numero de salida en el encabezado
            numSalida.dataset.numSalida = "" + datos.numSalidas;               //Guarda el num salida en el dataset
            //contenedores combo
            datos.contenedores.map(contenedor => {
                Contenedor.insertAdjacentHTML('beforeend', `<option value="${contenedor.IdContenedor}">${contenedor.Descripcion}</option>`);
            });
        }


    }
})
