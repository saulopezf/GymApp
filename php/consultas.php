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
    }
/*SELECT * FROM (
        SELECT fromMsg AS fromMsg1,toMsg AS toMsg1,MAX(fechaMsg) AS fechaMsg FROM mensajes WHERE toMsg='11111111T' GROUP BY fromMsg
        UNION ALL
        SELECT fromMsg AS fromMsg2,toMsg AS toMsg2,MAX(fechaMsg) AS fechaMsg FROM mensajes WHERE fromMsg='11111111T' GROUP BY toMsg
    ) AS u WHERE fromMsg1!=toMsg2

SELECT IF(fromMsg='11111111T', fromMsg, IF(toMsg='11111111T',toMsg,CONTINUE)) AS userMsg,toMsg,MAX(fechaMsg),mensaje 
FROM mensajes
GROUP BY toMsg

SELECT nombre,apellido,c3.dni,c3.mensaje,c3.fechaMsg FROM(SELECT c1.toMsg as dni,c1.mensaje,c1.fechaMsg FROM(SELECT * FROM mensajes WHERE fromMsg='11111111T') AS c1
                                   UNION ALL
                                   SELECT c2.fromMsg as dni,c2.mensaje,c2.fechaMsg FROM(SELECT * FROM mensajes WHERE toMsg='11111111T') AS c2) AS c3 
INNER JOIN usuarios ON usuarios.dni=c3.dni 
WHERE c3.fechaMsg = (SELECT MAX(c3.fechaMsg) FROM mensajes WHERE (fromMsg='11111111T' AND toMsg=c3.dni) OR  (fromMsg=c3.dni AND toMsg='11111111T'))

SELECT nombre,apellido,fromMsg,toMsg,MAX(fechaMsg) as fechaMsg,mensaje FROM mensajes INNER JOIN usuarios ON fromMsg=dni
                    WHERE toMsg='$dniUsuario' GROUP BY fromMsg
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