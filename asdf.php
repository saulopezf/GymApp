<?php 

/*$asdf = "lucia";
$pass = hash_hmac('sha512', $asdf, 'secret');
echo $pass;*/

function getFechaActual(){
        $ahora = getdate();
        $mon = $ahora['mon'];
        $mday = $ahora['mday'];
        if($mon<10){
            $mon = "0".$ahora['mon'];
        }
        if($mday<10){
            $mday = "0".$ahora['mday'];
        }
        return $ahora['year']."-".$mon."-".$mday;    
    }

$asdf = getFechaActual();
echo $asdf;

?>