//
const numExt = document.getElementById("numExt");
const productor = document.getElementById("productor");

$.ajax({
    url: 'ExtraviadosArchivos/peticiones/obtenerCampos.php',
    type: 'POST',
    success: function (res) {

        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto

        //Productor
        if (datos.nomProduc == "No hay Productor") {
            $('#registrar').prop('disabled', true);
            Swal.fire({
                icon: 'warning',
                title: 'No se encontró al Productor',
                text: 'Por favor ingrese con una cuenta de Productor',
                showConfirmButton: false,
                timer: 2000
            });

        } else {
            productor.placeholder = datos.nomProduc; //Ubica al usuario en el input
            productor.dataset.idProduc = "" + datos.idProduc; //Asigna el id del distribuidor al dataset
        }

        //numExt
        numExt.textContent = "Número de extraviados: " + datos.extraviados; //Coloca el numero de orden en el encabezado
        numExt.dataset.numExtraviados = "" + datos.extraviados;               //Guarda el num orden en el dataset
    }
})
