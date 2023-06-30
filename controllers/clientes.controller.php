<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/clientes.model.php');
$Clientes = new ClientesModel; //TODO:Declaracion de variable
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
            $nombres = $_POST['nombres'];
            $telefono = $_POST['telefono'];
            
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $Clientes->Insertar($nombres,$telefono);
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
