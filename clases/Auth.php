<?php 
    include "Conexion.php";

    class Auth extends Conexion {
        public function registrar($usuario, $password) {
            $conexion = parent::conectar();
            $sql = "INSERT INTO t_usuarios (usuario, password) 
                    VALUES (?,?)";
            $query = $conexion->prepare($sql);
            $query->bind_param('ss', $usuario, $password);
            return $query->execute();
        }

        public function logear($usuario, $password) {
            $conexion = parent::conectar();
            $passwordExistente = "";
            $sql = "SELECT * FROM t_usuarios 
                    WHERE usuario = '$usuario'";
            $respuesta = mysqli_query($conexion, $sql);
            $passwordExistente = mysqli_fetch_array($respuesta)['password'];
            
            if (password_verify($password, $passwordExistente)) {
                $_SESSION['usuario'] = $usuario;
                return true;
            } else {
                return false;
            }
        }   
    }

?>