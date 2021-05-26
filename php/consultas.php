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

    $consulta = $_POST['consulta'];
    switch ($consulta) {
        case "getUsuarioActual":
            exit($_SESSION['userData']['dni']);
            break;
        case "listaMonitores":
            $sql = "SELECT dni,nombre,apellido,titulacion FROM monitor INNER JOIN usuario ON usuario.dni=monitor.dniMonitor";
            break;
        case "listaDeChats":
            $dniUsuario = $_SESSION['userData']['dni'];
            $sql = "SELECT nombre,apellido,c3.dni AS dni,c3.mensaje AS mensaje,c3.fechaMsg AS fechaMsg FROM(SELECT c1.toMsg as dni,c1.mensaje,c1.fechaMsg FROM(SELECT * FROM mensajes WHERE fromMsg='$dniUsuario') AS c1 UNION ALL SELECT c2.fromMsg as dni,c2.mensaje,c2.fechaMsg FROM(SELECT * FROM mensajes WHERE toMsg='$dniUsuario') AS c2) AS c3 INNER JOIN usuarios ON usuarios.dni=c3.dni WHERE c3.fechaMsg IN (SELECT MAX(fechaMsg) FROM mensajes WHERE (fromMsg='$dniUsuario' AND toMsg=c3.dni) OR  (fromMsg=c3.dni AND toMsg='$dniUsuario')) ORDER BY fechaMsg DESC";
            break;
        case "ultimoMensaje":
            $dniUsuario = $_SESSION['userData']['dni'];
            $dniChat = $_POST['dniChat'];
            $sql = "SELECT s.mensaje FROM (SELECT fromMsg,toMsg,mensaje,fechaMsg FROM mensajes WHERE (fromMsg='$dniUsuario' AND toMsg='$dniChat') OR  (fromMsg='$dniChat' AND toMsg='$dniUsuario') ORDER BY fechaMsg ASC) s WHERE s.fechaMsg=(SELECT MAX(fechaMsg) FROM mensajes WHERE (fromMsg='$dniUsuario' AND toMsg='$dniChat') OR  (fromMsg='$dniChat' AND toMsg='$dniUsuario') ORDER BY fechaMsg ASC)";
            break;
        case "mensajesChat":
            $dniUsuario = $_SESSION['userData']['dni'];
            $dniChat = $_POST['dniChat'];
            $sql = "SELECT fromMsg,toMsg,mensaje,fechaMsg FROM mensajes WHERE (fromMsg='$dniUsuario' AND toMsg='$dniChat') OR  (fromMsg='$dniChat' AND toMsg='$dniUsuario') ORDER BY fechaMsg ASC";
            break;
        case "enviarMsg":
            $dniUsuario = $_SESSION['userData']['dni'];
            $dniChat = $_POST['dniChat'];
            $mensaje = $_POST['mensaje'];
            $sql = "INSERT INTO mensajes VALUES (null,'$dniUsuario','$dniChat','$mensaje',NOW())";
            break;
        case "nuevoChat":
            $dniChat = $_POST['dniChat'];
            $sql = "SELECT nombre,apellido FROM usuarios WHERE dni='$dniChat'";
            break;
    }

    $resultado_sql=mysqli_query($conexion,$sql);
    if(!$resultado_sql){
        exit("error");
    }
    $mijson=array();
    while($row = mysqli_fetch_assoc($resultado_sql)){
        $mijson[]=$row;
    }
    $json = json_encode($mijson);
    exit($json);


?>