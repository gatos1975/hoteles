<?php
//TODO: archivos requeridos
require_once('../config/config.php');
//require_once('usuariosroles.model.php');

class CiudadesModel
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
        $cadena = "SELECT * FROM ciudades";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function Actualizar($idciudad, $ciudad, $detalle){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE `ciudades` SET `ciudad`='$ciudad', `detalle`='$detalle' WHERE idciudad=$idciudad";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function uno($idciudad){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `ciudades`  where idciudad = $idciudad";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }
    public function Insertar($ciudad, $detalle){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `ciudades`(`ciudad`, `detalle`) VALUES ('$ciudad','$detalle')";
        $datos = mysqli_query($con,$cadena);
        
        /*/if(mysqli_insert_id($con) > 0){
            //definir el modelo usuarios_roles
            $UsuarioRoles = new UsuariosRolesModel();
            return $UsuarioRoles->Insertar(mysqli_insert_id($con), $idRoles);
        }else{
            return 'Error al insertar el rol del usuario';
        }*/

    }
    
    /*public function Eliminar($idciudad){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `ciudades` WHERE idciudad=$idciudad ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }*/
    //FUNCION Q ELIMINA REGISTROS DE UNA TABLA PADRE E HIJA
    public function Eliminar($idciudad){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `hoteles` WHERE idciudad=$idciudad ";
        //$cadena = "DELETE FROM `Usuario` WHERE idUsaurio=$idUsaurio ";
        $resultadoHija = mysqli_query($con, $cadena);

        // Verificar si la eliminación en la tabla hija fue exitosa
        if ($resultadoHija) {
            // Eliminar el registro de la tabla padre
            $consultaPadre = "DELETE FROM `ciudades` WHERE idciudad=$idciudad ";
            $resultadoPadre = mysqli_query($con, $consultaPadre);
        
            // Verificar si la eliminación en la tabla padre fue exitosa
            if ($resultadoPadre) {
                return 'ok';
                echo "Registros eliminados correctamente.";
            } else {
                echo "Error al eliminar registro de la tabla padre: " . mysqli_error($conexion);
            }
        } else {
            return mysqli_error($conv);
            echo "Error al eliminar registros de la tabla hija: " . mysqli_error($conexion);
        }
        
        //if (mysqli_query($con, $cadena) ){
            //cadena2 = "DELETE FROM `Usuario` WHERE idUsaurio=$idUsaurio ";
           // if (mysqli_query($con, $cadena2) ){
             //   return 'ok';
            //}
            //else {
                //return mysqli_error($conv); # code...
            //}
        
    }
    
}
