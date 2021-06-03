<?php

    function conexion(){
        if(isset($_SESSION['userData'])){
            $usuario_bd = $_SESSION['userData']['user'];
            $password_bd = $_SESSION['userData']['user'];
        }
        else{
            $usuario_bd = 'guest';
            $password_bd = 'guest';
        }
        $host='localhost';
        $nombre_bd='gimnasio';
        $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
        if (mysqli_connect_errno()) { //(!$conexion)
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            exit();
        }
        return $conexion;

    }
?>