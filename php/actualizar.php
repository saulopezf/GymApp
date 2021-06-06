<?php
    include "conexion.php";
    session_start();

    if(!empty($_SESSION['userData'])){

        $conexion=conexion();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $password=$_POST['password'];
            $pass_code=hash_hmac('sha512', $_POST['password'], 'secret');

            $sql = "SELECT * FROM usuarios
                    WHERE user='$usuario' AND pass='$pass_code'";
            $resultado = mysqli_query($conexion, $sql);

            if(mysqli_num_rows($resultado)==0){
                header("location:error.php");
            }


            $dni = $_SESSION['userData']['dni'];
            if(isset($_POST['submitTlfno'])){
                $sql = "UPDATE usuarios SET telefono = '".$_POST['tlfno']."' WHERE dni = '$dni'";
            }
            if(isset($_POST['submitMail'])){
                $sql = "UPDATE usuarios SET mail = '".$_POST['mail']."' WHERE dni = '$dni'";
            }
            if(isset($_POST['submitPass'])){
                $newpass_code=hash_hmac('sha512', $_POST['newpassword'], 'secret');
                $sql = "UPDATE usuarios SET pass = '$newpass_code' WHERE dni = '$dni'";
            }

            $actualizar = mysqli_query($conexion, $sql);
            if($actualizar){
                $_SESSION['actualizar'] = true;
                header("location:../config.php");
            }
            else{
                header("location:error.php");
            }

        }
        else{
            header("location:../login.php");
        }
    }
    else{
        $_SESSION['error'] = "No se ha iniciado sesion";
        header("location:../error.php");
    }
            

?>