<?php
include "conexion.php";
session_start();

    if(!empty($_SESSION['userData'])){

        if($_SESSION['userData']['user']=='gymAsist'){

        $conexion=conexion();
        if (mysqli_connect_errno()) { //(!$conexion)
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            exit();
        }

        

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $idClase = $_POST['idClase'];
            if(isset($_POST['editarMonitor'])){
                $sql = "UPDATE clases SET dniMonitor = '".$_POST['monitorClase']."' WHERE idClase = '$idClase'";
            }
            if(isset($_POST['editarHorario'])){
                $sql = "INSERT INTO horarios VALUES(null,$idClase,'".$_POST['dia']."','".$_POST['horario'].":00','".($_POST['horario']+1).":00')";
            }
            if(isset($_POST['editarImagen'])){
                $sql = "UPDATE clases SET img = '".$_POST['']."' WHERE idClase = '$idClase'";
            }
            if(isset($_POST['quitarHorario'])){
                $idHorario = intval($_POST['quitarHorario']);
                $sql = "DELETE FROM horarios WHERE horarios.idClase = '$idClase' AND horarios.id = $idHorario";
                
            }
            var_dump($sql);
            $actualizar = mysqli_query($conexion, $sql);
            if($actualizar){
                header("location:../clases.php?idClase=".$idClase);
            }
            else{
                $_SESSION['error'] = "No se ha podido editar la clase";
                header("location:../error.php");
            }

        }
    }
    else{
        header("location:../index.php");
    }
    }
    else{
        header("location:../index.php");
    }
            

?>