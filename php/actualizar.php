<?php
    session_start();

    //if(!empty($_SESSION)){

        //$usuario=$_SESSION['rol'];

        $host='localhost';
        $usuario_bd='root';
        $password_bd='';
        $nombre_bd='gimnasio';
        $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
        if (mysqli_connect_errno()) { //(!$conexion)
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            exit();
        }

        

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
                header("location:../config.php");
            }
            else{
                header("location:error.php");
            }

        }
            

?>