$(document).ready(function () {
   function combocat() {
      let tipoFuncion = "combo2";
      let parametros = { "tipo": tipoFuncion }
      $.ajax({
         url: 'metodosCont.php',
         data: parametros,
         type: 'POST',
         success: function (response) {
            $('#intipocont').html(response);
         }
      });
   }

   function comboRespon() {
      $('#intipoorigen').on('change', function () {
         console.log(this.value);
         let tipoOrigen = this.value;

         $.ajax({
            url: 'metodosCont.php',
            data: { "tipo": "responsables", "origen": tipoOrigen },
            type: 'POST',
            success: function (response) {
               if (response == "No hay responsables") {
                  $('#inrespon option').remove();
                  //!Poner mensaje de que no hay recolectores
               } else {
                  $('#inrespon').html(response);
               }

            }
         });
      });
   }
   $('#btnEditar').click(function (e) {
      combocat();
      comboRespon();
   });


   $('#frm').submit(function (e) {
      e.preventDefault();

      let formData = new FormData(this);
      formData.append("tipo", "actualizar");
      console.log(formData);
      $('#frm :input').prop("disabled", true);
      $('#btnGuardar').prop("disabled", true);
      $('#btnEditar').prop("disabled", true);

      $.ajax({
         url: 'actualizar.php',
         data: formData,
         type: 'POST',
         contentType: false,
         cache: false,
         processData: false,
         success: function (response) {
            console.log(response);
            // if (response == "Todo Correcto") {
            //    Swal.fire({
            //       icon: 'success',
            //       title: 'Todo correcto',
            //       text: 'Se registro el contenedor correctamente',
            //       showConfirmButton: true,
            //       confirmButtonText: 'Ok',
            //       confirmButtonColor: '#285430',
            //    }).then((result) => {
            //       if (result.isConfirmed) {
            //          //location.reload();
            //       }
            //    });
            // } else {
            //    console.log(response);
            //    Swal.fire({
            //       icon: 'error',
            //       title: 'Error',
            //       text: 'Ocurrió un error inesperado',
            //    }).then((result) => {
            //       if (result.isConfirmed) {
            //          //location.reload();
            //       }
            //    });
            // }
         }
      });
   });

   $('#borrar').click(function (e) {
      let tipofuncion = "borrar";
      let idcat = document.getElementById("incat").value;
      let parametros = { "idcat": idcat, "tipo": tipofuncion };
      $.ajax({
         url: 'metodosCat.php',
         data: parametros,
         type: 'POST',
      });

   });
});