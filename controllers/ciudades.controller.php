<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/ciudades.model.php');
$ciudades = new CiudadesModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $ciudades ->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $idciudad = $_POST['idciudad'];    
            $datos = array();   
            $datos = $ciudades->uno($idciudad);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $ciudad = $_POST['ciudad'];
            $detalle = $_POST['detalle'];
            //$Apellidos = $_POST['Apellidos'];
            //$correo = $_POST['correo'];
            //$contrasenia = $_POST['contrasenia'];
            //$idRoles = $_POST['idRoles'];
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $ciudades->Insertar($ciudad,$detalle);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
                $idciudad = $_POST['idciudad'];   
                $ciudad = $_POST['ciudad']; 
                $detalle = $_POST['detalle'];       
                $datos = array();        
                $datos = $ciudades->Actualizar($idciudad, $ciudad, $detalle);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $idciudad = $_POST['idciudad'];       
                $datos = array();        
                $datos = $ciudades->Eliminar($idciudad);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
