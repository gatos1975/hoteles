<?php
//TODO: archivos requeridos
require_once('../config/config.php');
//require_once('usuariosroles.model.php');

class ReservacionesModel
{
    public function login($correo, $contrasenia)
    {
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuario  WHERE correo = '$correo' and contrasenia='$contrasenia'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }
    
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM habitaciones inner join hoteles on habitaciones.idhotel=hoteles.idhotel inner join ciudades on ciudades.idciudad=hoteles.idciudad WHERE habitaciones.estado='LIBRE'";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function Actualizar($idhabitacion, $numero,$descripcion,){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE `habitaciones` SET `numero`='$numero',`descripcion`='$descripcion' WHERE idhabitacion=$idhabitacion";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function uno($idhabitacion){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM habitaciones inner join hoteles on habitaciones.idhotel=hoteles.idhotel inner join ciudades on ciudades.idciudad=hoteles.idciudad  where idhabitacion = $idhabitacion";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }
    public function Insertar($nombres,$telefono){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `clientes`(`nombres`,`telefono`) VALUES ('$nombres','$telefono' )";
        $datos = mysqli_query($con,$cadena);
 
    }
    public function Eliminar($idhabitacion){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `habitaciones` WHERE idhabitacion=$idhabitacion ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
   
    
}
