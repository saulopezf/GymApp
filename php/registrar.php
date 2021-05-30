<?php

	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

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
	    	if(isset($_POST['nuevaClase'])){
	    		$sql = "INSERT INTO clases VALUES (null,'".$_POST['monitorClase']."','".$_POST['nombreClase']."');";
				$insertarClase = mysqli_query($conexion, $sql);

				if($insertarClase){
					$sql = "SELECT max(idClase) as idClase FROM clases";
					$resultado = mysqli_query($conexion, $sql);
					$claseInsertada = mysqli_fetch_assoc($resultado);

					$horarios = (count($_POST) - 3)/2;
					for ($i=0; $i < $horarios; $i++) { 
						$dia = $_POST["diasSemana".$i];
                        $horaInicio = $_POST["horario".$i];
                        $horaFin = $horaInicio+1;
						$sql = "INSERT INTO horarios VALUES (null,'".$claseInsertada['idClase']."','$dia','$horaInicio:00','$horaFin:00');";
						$insertarHorario = mysqli_query($conexion, $sql);
					}
				}
				else{
					echo "asdf";
				}
				
	    	}
	    	if(isset($_POST['registrar'])){
		    	$randomPass = randomPassword();
		    	$pass = hash_hmac('sha512', $randomPass, 'secret');
		    	$sql = "INSERT INTO usuarios VALUES ('".$_POST["dni"]."', '".$_POST["nombre"]."', '".$_POST["apellidos"]."', '".$_POST["sexo"]."', '".$_POST["fecha"]."', ".$_POST["tlfno"].", '".$_POST["mail"]."', '".$_POST["user"]."', '$pass', 'matriculado');";
				$insertarUsuario = mysqli_query($conexion, $sql);
				if($insertarUsuario){
					$sql = "INSERT INTO matriculados VALUES ('".$_POST["dni"]."', null, null, null);";
					$insertarMatriculado = mysqli_query($conexion, $sql);
					if($insertarMatriculado){
						mail($_POST["mail"], "Matricula en GymApp", "Se te ha matriculado correctamente en GymApp\nSu usuario es: ".$_POST["user"]."\nSu contraseña: $randomPass\nPor favor cambie su contraseña lo antes posible");
					}
					else{
						header("location:../error.php");
					}
				}
			}
		}
			else{
				header("location:../error.php");
			}
			
	/*}
	else{
		header("location:../index.php");
	}*/

?>