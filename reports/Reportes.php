<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     include('database.php');
//     $conn = new PDO('mysql:host=' . $host_name . ';dbname=' . $database, $host_user, $host_password);

include("../conexion.php");

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else {
    session_start();

    switch ($_POST['opcion']) {
            //Reporte Envases mas ordenados1
        case '1':
            $query = "SELECT TipoEnvase, SUM(CantidadPiezas) as Total from detalleorden GROUP BY TipoEnvase order by Total DESC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

            //Reporte de distribuidores más concurridos 2
        case '2':
            $query = "SELECT D.Nombre , COUNT(*) as Total FROM ordenproductos as OP INNER JOIN distribuidores as D on OP.IdDistribuidor = D.IdDistribuidor GROUP by D.Nombre ORDER BY Total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

            //Reporte de contenedores más concurridos 3
        case '3':
            $query = "SELECT CONCAT(c.IdContenedor,',',c.Origen) as Contenedor,count(*) as Total from entregas as E INNER JOIN contenedores as c on E.IdContenedor=c.IdContenedor group BY Contenedor order by Total DESC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
            //Reporte de productores con más ordenes 4
        case '4':
            $query = "SELECT P.Nombre, count(*) as Total from productores as P INNER JOIN ordenproductos as OP on P.IdProductor = OP.IdProductor GROUP by P.Nombre Order By Total DESC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
            //Reporte de municipios con menos entregas 5
        case '5':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario=4 GROUP by U.Nombre Order BY Total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
            //Reporte de distribuidores con menos entregas 6
        case '6':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario='3' GROUP by U.Nombre Order BY Total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
            //Reporte de contenedores con menos salidas 7
        case '7':
            $query = "SELECT CONCAT(c.IdContenedor,',',c.Origen) as Contenedor,count(*) as Total from entregas as E INNER JOIN contenedores as c on E.IdContenedor=c.IdContenedor group BY Contenedor order by Total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

            // Reporte de todas las entregas por productor 8
        case '8':
            $query = "SELECT P.Nombre,COUNT(*) as Total from entregas as E INNER JOIN productores as P on E.IdProductor = P.IdProductor GROUP BY P.Nombre";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

            // Reporte de todos los extraviados por productor 9
        case '9':
            $query = "SELECT P.Nombre,COUNT(*) as Total from extraviados as E INNER JOIN productores as P on E.IdProductor = P.IdProductor GROUP BY P.Nombre";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //
            break;

            // Distribuidores  ***********************************************************************************************************************
            // Reporte de ordenes generadas por productor 10
        case '10':
            $query = "SELECT P.Nombre,COUNT(*) as Total from ordenproductos as O INNER JOIN productores as P on O.IdProductor = P.IdProductor GROUP BY P.Nombre";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result);
            break;
            // Reporte de entregas por distribuidor 11
        case '11':
            $query = "SELECT P.Nombre,COUNT(*) as Total from ordenproductos as O INNER JOIN productores as P on O.IdProductor = P.IdProductor GROUP BY P.Nombre";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result);
            break;

            // Reporte de salidas por distribuidor 12

            // case '12':
            //     $query = "SELECT P.Nombre,COUNT(*) as Total from ordenproductos as O INNER JOIN productores as P on O.IdProductor = P.IdProductor GROUP BY P.Nombre";
            //     $result = mysqli_query($enlace, $query);
            //     $data = array();
            //     foreach ($result as $row) {
            //         $data[] = $row;
            //     }
            //     echo json_encode($data);
            //     mysqli_free_result($result);
            //     break;

            // Reporte de salidas (limpieza de contenedores) General X fecha 13
            
            // case '13':
            //     $query = "SELECT P.Nombre,COUNT(*) as Total from ordenproductos as O INNER JOIN productores as P on O.IdProductor = P.IdProductor GROUP BY P.Nombre";
            //     $result = mysqli_query($enlace, $query);
            //     $data = array();
            //     foreach ($result as $row) {
            //         $data[] = $row;
            //     }
            //     echo json_encode($data);
            //     mysqli_free_result($result);
            //     break;



            // Municipio 
            // Reporte de entregas por municipio  
            case '11':
                $query = "SELECT P.Nombre,COUNT(*) as Total from ordenproductos as O INNER JOIN productores as P on O.IdProductor = P.IdProductor GROUP BY P.Nombre";
                $result = mysqli_query($enlace, $query);
                $data = array();
                foreach ($result as $row) {
                    $data[] = $row;
                }
                echo json_encode($data);
                mysqli_free_result($result);
                break;
            // Reporte de entregas (envases vacíos recibidos ) General X fechas 
            // Reporte de salidas (limpieza de contenedores) por municipio 
            // Reporte de salidas (limpieza de contenedores) General X fecha

            // Empresa Privada Recolectora
            // Reporte de entregas (envases vacíos recibidos ) por EPR  
            // Reporte de entregas (envases vacíos recibidos ) General X fechas 

            // Contenedores 
            // Reporte de contenedores sin capacidad (ósea llenos)
            // Reporte de contenedores sin capacidad (ósea llenos) X municipio
            // Reporte de contenedores con fecha de ultima recolección mayor a X tiempo (1 mes o mas de un mes sin limpiar)
            // Reporte de contenedores con más movimiento (que se repitan mas en las salidas

    }
    mysqli_close($enlace);
}
