<?php
//TODO: archivos requeridos
require_once('../config/config.php');
//require_once('usuariosroles.model.php');

class UsuariosModel
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
        $cadena = "SELECT * FROM usuario";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function Actualizar($idUsaurio, $Nombres, $Apellidos, $Contrasenia, $Correo){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE `usuario` SET `nombres`='$Nombres', `apellidos`='$Apellidos',`contrasenia`='$Contrasenia',`correo`='$Correo' WHERE idusaurio=$idUsaurio";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function uno($idUsaurio){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `usuario`  where idUsaurio = $idUsaurio";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }
    public function Insertar($Nombres, $Apellidos,  $contrasenia,$correo){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `usuario`(`Nombres`, `Apellidos`, `contrasenia`, `correo`) VALUES ('$Nombres','$Apellidos','$contrasenia','$correo')";
        $datos = mysqli_query($con,$cadena);
        
        /*/if(mysqli_insert_id($con) > 0){
            //definir el modelo usuarios_roles
            $UsuarioRoles = new UsuariosRolesModel();
            return $UsuarioRoles->Insertar(mysqli_insert_id($con), $idRoles);
        }else{
            return 'Error al insertar el rol del usuario';
        }*/

    }
    public function Eliminar($idUsaurio){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `usuario` WHERE idUsaurio=$idUsaurio ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    //FUNCION Q ELIMINA REGISTROS DE UNA TABLA PADRE E HIJA
    /*public function Eliminar($idUsaurio){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `usuarios_roles` WHERE idUsuario=$idUsaurio ";
        //$cadena = "DELETE FROM `Usuario` WHERE idUsaurio=$idUsaurio ";
        $resultadoHija = mysqli_query($con, $cadena);

        // Verificar si la eliminación en la tabla hija fue exitosa
        if ($resultadoHija) {
            // Eliminar el registro de la tabla padre
            $consultaPadre = "DELETE FROM `Usuario` WHERE idUsaurio=$idUsaurio ";
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
        
    }*/
    
}
