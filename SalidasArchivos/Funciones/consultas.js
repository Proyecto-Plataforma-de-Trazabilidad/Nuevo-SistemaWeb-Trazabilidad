$(document).ready(function () {

    generarTabla();
});
function generarTabla() {

    $('#tableSalidas').DataTable({
        destroy: true,
        ajax: {
            "method": "POST",
            "url": "consultas.php",
            "complete": function (res) {
                console.log(res);
                if (res.responseText == "TipoUsuario") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Lo lamento!',
                        text: 'No tiene los permisos necesarios para acceder',
                    });
                } else if (res.responseText == "SinProductor") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Lo lamento!',
                        text: 'No existen registros de este productor',
                    });
                } else if (res.responseText == "Error") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Lo lamento!',
                        text: 'Succedio un error al buscar los datos',
                    });
                }
                else
                    return res.responseText;
            }
        },
        columns: [
            { data: "IdSalida" },
            { data: "IdContenedor" },
            { data: "Origen" },
            { data: "Nombre" },
            { data: "Responsable" },
            { data: "Cantidad" },
            { data: "fecha" },
        ]
    });

}
