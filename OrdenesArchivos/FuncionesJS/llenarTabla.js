
$(document).ready(function(){
    let numDetalle = document.getElementById("numDetalle");
    let valColor, aplica;
    let i = 1;

    $("#tipoQuimi").change(function() {
      let opcionQuimico = $("#tipoQuimi option:selected").text();

      if (opcionQuimico != "Plaguicidas") {
          
          $("#color").prop('disabled', true);
          aplica = false;

      } else {
          $("#color").prop('disabled', false);
          aplica = true;
      }
    });

    $('#aceptar').click(function() {
        //let valQuimico = document.getElementById("tipoQuimi").textContent; tomar el texto de option quimico
        let valQuimico = $("#tipoQuimi option:selected").text(); //texto del tipoquimico
        let numQuimco= document.getElementById('tipoQuimi').value;
        let valEnvase = document.getElementById("tipoEnva").value;
        let valPiezas = document.getElementById("cantiPza").value;

        if(aplica == true)
          valColor = document.getElementById("color").value;
        else
          valColor = "No Aplica";

        //en DOM SE GUARDA COMO 'tableIdquimico'
        let fila = '<tr  id="row' + i + '"><td>' + i + '</td><td id="celdaIdQuimico" data-table-idQuimico='+numQuimco+'>' + valQuimico + '</td><td>' + valEnvase + '</td><td>' + valColor + '</td><td>' + valPiezas + '</td><td><button style="background-color: #dc3545 !important" type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';
        
        i++;
        
        numDetalle.textContent = "Detalle de orden: 00" + i;
        
        $('#detalle tbody:first').before(fila);

        document.getElementById("tipoQuimi").value ="";
        document.getElementById("tipoEnva").value = "";
        document.getElementById("color").value = "";
        document.getElementById("cantiPza").value = "";
        document.getElementById("tipoQuimi").focus();
    });
    
    $(document).on('click', '.btn_remove', function() {
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
            //Borrar el elemento de la tabla
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            //Recalcular indices
            i--;
            numDetalle.textContent = "Detalle de orden: 00" + i;
            let container = document.querySelector('#detalle');
            let celdasId = container.querySelectorAll('tr');
            if(celdasId.length > 1){
              for (let i = 1; i < celdasId.length; i++) {
                celdasId[i].id = "row"+i; //Cambia el id de la fila
                celdasId[i].firstChild.textContent = i; //Coloca la numeración en la primera columna
                celdasId[i].lastChild.childNodes[0].id = i; //Reasigna la id del botón que elimina
              }
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
