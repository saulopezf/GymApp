<?php
	include "php/conexion.php";
	session_start();

    $conexion=conexion();

    $dni = $_SESSION['userData']['dni'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
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
	    	$_SESSION['error'] = "No se ha podido apuntar a la clase";
			header("location:../error.php");
		}
		else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
    
    
?>