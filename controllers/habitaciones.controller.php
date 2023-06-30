<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/habitaciones.model.php');
$Habitaciones = new HabitacionesModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Habitaciones ->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $idhabitacion = $_POST['idhabitacion'];    
            $datos = array();   
            $datos = $Habitaciones->uno($idhabitacion);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $numero = $_POST['numero'];
            $descripcion = $_POST['descripcion'];
            $idHotel = $_POST['idHotel'];
            //$Apellidos = $_POST['Apellidos'];
            //$correo = $_POST['correo'];
            //$contrasenia = $_POST['contrasenia'];
            //$idRoles = $_POST['idRoles'];
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $Habitaciones->Insertar($numero,$descripcion,$idHotel);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
                $idhabitacion = $_POST['idhabitacion'];   
                $numero = $_POST['numero']; 
                $descripcion = $_POST['descripcion'];       
                $datos = array();        
                $datos = $Habitaciones->Actualizar($idhabitacion, $numero, $descripcion);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $idhabitacion = $_POST['idhabitacion'];       
                $datos = array();        
                $datos = $Habitaciones->Eliminar($idhabitacion);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
