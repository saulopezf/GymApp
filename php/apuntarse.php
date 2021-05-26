<?php
	
	session_start();

    $host='localhost';
    $usuario_bd='root';
    $password_bd='';
    $nombre_bd='gimnasio';
    $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
    if (mysqli_connect_errno()) { //(!$conexion)
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        exit();
    }
    $dni = $_SESSION['userData']['dni'];
    if(isset($_POST['apuntarse'])){
	    $idHorario = $_POST['apuntarse'];
	    $sql = "INSERT INTO `apuntados` (`dniMatriculado`, `idHorario`) VALUES ('$dni', '$idHorario');";
	    $sentencia = mysqli_query($conexion, $sql);
    }
    if(isset($_POST['desapuntarse'])){
    	$idHorario = $_POST['desapuntarse'];
	    $sql = "DELETE FROM apuntados WHERE apuntados.dniMatriculado = '$dni' AND apuntados.idHorario = $idHorario";
	    $sentencia = mysqli_query($conexion, $sql);
    }
    if(!$sentencia){
		header("location:../error.php");
	}
	else{
		header("location:../calendario.php");
	}
    
    
?>