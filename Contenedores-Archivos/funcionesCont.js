$(document).ready(function(){

    function combocat(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'Contenedores-Archivos/metodosCont.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#intipocont').html(response);
            }
        });
    }
    combocat();

    $.ajax({
        url:'Contenedores-Archivos/metodosCont.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
    window.addEventListener('resize', function(event){
        $('#tabla').DataTable().fnDestroy();
        $('#tabla').DataTable({
            scrollX:true,
        });
    },true);

    
    $('#intipoorigen').on('change', function() {
        console.log(this.value);
        let tipoOrigen = this.value;
        
        $.ajax({
            url:'Contenedores-Archivos/metodosCont.php',
            data:{"tipo":"responsables", "origen": tipoOrigen},
            type:'POST',
            success:function(response){
                if (response == "No hay responsables") {
                    $('#inrespon option').remove();
                    //!Poner mensaje de que no hay recolectores
                } else {
                    $('#inrespon').html(response);
                }

                
            }
        });
    });
});

