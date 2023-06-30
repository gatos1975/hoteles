<?php
error_reporting(0);
//TODO: Requerimeintos
//require_once('../config/sesiones.php');
require_once('../models/hoteles.model.php');
$Hoteles = new HotelesModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET
   
    case 'login': // Cao 1: Login
        $correo = $_POST['correo']; //TODO: Declaccion de variable para obtener datos tipo POST
        $contrasenia = $_POST['contrasenia'];
        if (empty($correo) or empty($contrasenia)) {  //TODO:Validacion de variables
            header("Location:../index.php?op=2"); //TODO:redirecionamiento a pagina index
            exit(); //TODO:fin de ejecucion de codigo
        }
        $datos = array();
        $datos = $Usuario->login($correo, $contrasenia);
        $res = mysqli_fetch_assoc($datos);
        try {
            if (is_array($res) and count($res) > 0) {
                $_SESSION['idUsuario'] = $res['idUsaurio'];
                $_SESSION['Nombres'] = $res['Nombres'];
                $_SESSION['Apellidos'] = $res['Apellidos'];
                $_SESSION['correo'] = $res['correo'];
                //$_SESSION['idRoles'] = $res['idRoles'];
                //$_SESSION['Detalle'] = $res['Detalle'];
                //header('Location:../views/Dashboard/');
                header('Location:../home.html');
                exit();
            } else {
                //header("Location:../index.php?op=1");
                header("Location:../index.php?op=1");
                exit();
            }
        } catch (Throwable $th) {
            echo json_encode($th->getMessage());
        }
        break;
        
        case 'uno':
            $idHotel = $_POST['idHotel'];    
            $datos = array();   
            $datos = $Hoteles->uno($idHotel);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

    case 'todos':
        $datos = array();
        $datos = $Hoteles->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;

    case 'insertar':
        $nombre = $_POST['nombre'];
        $idciudad = $_POST['idciudad'];
        
       
        //$idRoles = $_POST['idRoles'];
        $datos = array();
        $datos = $Hoteles->Insertar($nombre, $idciudad); 
        echo json_encode($datos);
        break;

        case 'actualizar':
            $idHotel = $_POST['idHotel'];   
            $nombre = $_POST['nombre'];  
                 
            $datos = array();        
            $datos = $Hoteles->Actualizar($idHotel,$nombre);        
            //$respuesta = mysqli_fetch_assoc($datos);        
            echo json_encode($datos);        
            break;
    case 'eliminar':        
        $idHotel = $_POST['idHotel'];       
        $datos = array();        
        $datos = $Hoteles->Eliminar($idHotel);       
        //$respuesta = mysqli_fetch_assoc($datos);       
        echo json_encode($datos);       
        break;
}