const entrega = document.getElementById("numEntrega");
const tipoRecolect = document.getElementById("tipoRecol");
const nombreRecolect = document.getElementById("nomRecol");
const nombreProdu = document.getElementById("nomProdu");
const nombrContenedor = document.getElementById("contene");


$.ajax({
    url: 'EntregasArchivos/Peticiones/obtenerCampos.php',
    type: 'GET',
    success: function (res) {
        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto

        if (datos.mensaje == "UsuarioNoPermitido") {
            $('#registrar').prop('disabled', true);
            Swal.fire({
                icon: 'warning',
                title: 'El usuario no es recolector',
                text: 'Por favor ingrese con una cuenta de recolector para registrar',
                showConfirmButton: false,
                timer: 2500
            });

        } else if (datos.mensaje == "RecoleUsuarioNoValido") {
            $('#registrar').prop('disabled', true);
            Swal.fire({
                icon: 'warning',
                title: 'No se encontró el usuario',
                text: 'La cuenta con la que ingreso no esta registrada como recolector',
                showConfirmButton: false,
                timer: 2500
            });
        } else {
            tipoRecolect.placeholder = datos.tipoRecol; //Ubica al tipo de usuario en el input
            tipoRecolect.dataset.tipoRecolector = datos.tipoRecol;

            nombreRecolect.placeholder = datos.nomRecol; //Ubica al nombre de usuario en el input
            nombreRecolect.dataset.nombreRecolect = datos.nomRecol;
        }

        entrega.textContent = "Numero de entrega: " + datos.entrega; //Coloca el numero de orden
        entrega.dataset.numEntrega = "" + datos.entrega;

        if (datos.produtores == "No hay productores") {
            Swal.fire({
                icon: 'error',
                title: 'No hay ningún productor registrado',
                text: 'Por favor vaya a registrar uno',
            }).then((result) => {
                if (result.isConfirmed) {
                    //aqui poner lo del wiondow location para que se valla a registrar productores
                }
            });
        } else {
            datos.produtores.map(productor => {
                nombreProdu.insertAdjacentHTML('beforeend', `<option value="${productor.IdProductor}">${productor.Nombre}</option>`);
            });//Rellena la combo proveedores  
        }

        if (datos.contenedores == "No hay contenedores") {
            Swal.fire({
                icon: 'error',
                title: 'No hay ningún contenedor registrado',
                text: 'Para poder registrar la entrega debe estar registrado como responsable de un contendedor',
            }).then((result) => {
                if (result.isConfirmed) {
                    //aqui poner lo del wiondow location para que se valla a registrar su contenedor
                }
            });
        } else {
            datos.contenedores.map(contenedor => {
                nombrContenedor.insertAdjacentHTML('beforeend', `<option value="${contenedor.IdContenedor}">${contenedor.Descripcion}</option>`);
            });//Rellena la combo proveedores  
        }

    }
})

