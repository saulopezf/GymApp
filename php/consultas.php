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
            $sql = "SELECT fromMsg,toMsg,MAX(fechaMsg) as fechaMsg FROM mensajes WHERE toMsg='$dniUsuario' GROUP BY fromMsg";
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
    }
/*SELECT * FROM (
        SELECT fromMsg AS fromMsg1,toMsg AS toMsg1,MAX(fechaMsg) AS fechaMsg FROM mensajes WHERE toMsg='11111111T' GROUP BY fromMsg
        UNION ALL
        SELECT fromMsg AS fromMsg2,toMsg AS toMsg2,MAX(fechaMsg) AS fechaMsg FROM mensajes WHERE fromMsg='11111111T' GROUP BY toMsg
    ) AS u WHERE fromMsg1!=toMsg2
SELECT IF(fromMsg='11111111T', fromMsg, IF(toMsg='11111111T',toMsg,CONTINUE)) AS userMsg,toMsg,MAX(fechaMsg),mensaje 
FROM mensajes
GROUP BY toMsg
*/
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