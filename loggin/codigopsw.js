$('#frmrecovery').submit(function (e) {
  e.preventDefault();

  var nuevapsw = $.trim($('#nuevapsw').val());
  var reppsw = $.trim($('#reppsw').val());
  var iduser = $.trim($('#iduser').val());

  console.log(iduser);
  console.log(nuevapsw);
  console.log(reppsw);
  

  if (nuevapsw.length == "" || reppsw.length == "") {
    Swal.fire({
      icon: 'warning',
      title: 'Llene todos los campos',
    });
    return false;
  } else {
    $.ajax({
      url: "respsw.php",
      type: "POST",
      datatype: "json",
      data: {nuevapsw: nuevapsw, reppsw: reppsw, iduser:iduser},
      success: function (dato) {
        if (dato == "null") {
          Swal.fire({
            icon: 'error',
            title: 'Las contraseñas no coinciden.',
            text: 'Intentar de nuevo.',
          });
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Contraseña actualizada correctamente',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ingresar'
          }).then((result) => {
            if (result.value) {
              window.location.href = "../index.php?message=success_psw";
            }
          });
        }
      }
    })
  }
});