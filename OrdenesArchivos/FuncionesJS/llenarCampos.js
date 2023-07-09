
const distri = document.getElementById("nomDistri");
const orden = document.getElementById("numOrden");
//const numOrden= orden.getAttribute('data-numOrden');
const tipoQuimi = document.getElementById("tipoQuimi");
const nombreProdu = document.getElementById("nomProdu");


function añadirQumicos(quimico) {
    let quimi = quimico;
    tipoQuimi.insertAdjacentHTML('beforeend', `<option value="${quimi.IdTipo}">${quimi.Concepto}</option>`);

}

function añadirProductor(productor) {
    let product = productor;
    nombreProdu.insertAdjacentHTML('beforeend', `<option value="${product.IdProductor}">${product.Nombre}</option>`);
}

$.ajax({
    url: 'OrdenesArchivos/Peticiones/obtenerCampos.php',
    type: 'GET',
    success: function (res) {

        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto

        if (datos.nomDristri == "No hay distribuidor") {
            $('#registrar').prop('disabled', true);
            Swal.fire({
                icon: 'warning',
                title: 'No se encontró al distribuidor',
                text: 'Por favor ingrese con una cuenta de distribuidor',
                showConfirmButton: false,
                timer: 2000
            });

        } else {
            distri.placeholder = datos.nomDristri; //Ubica al usuario en el input
            distri.dataset.idDistribuidor = "" + datos.IdDistri; //Asigna el id del distribuidor al dataset
        }

        orden.textContent = "Numero de orden: " + datos.orden; //Coloca el numero de orden en el encabezado
        orden.dataset.numOrden = "" + datos.orden;               //Guarda el num orden en el dataset

        if (datos.quimicos == "No hay quimicos") {
            Swal.fire({
                icon: 'error',
                title: 'No hay ningún químico registrado',
                text: 'Por favor vaya a registrar uno',
            }).then((result) => {
                if (result.isConfirmed) {
                    //aqui poner lo del wiondow location para que se valla a registrar quimicos
                }
            });
        } else
            datos.quimicos.map(quimico => añadirQumicos(quimico)); //Rellena la combo tipoQumicos


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
        } else
            datos.produtores.map(productor => añadirProductor(productor));//Rellena la combo proveedores      
    }
})






