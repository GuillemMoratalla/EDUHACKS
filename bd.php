<?php
    $cadena_connexio = 'mysql:dbname=demoBDPHP;host=localhost:3360';
    $usuari = 'root';
    $passwd = '';
    try{
        //Ens connectem a la BDs
        $db = new PDO($cadena_connexio, $usuari, $passwd);
        //Tallem la connexió a la BDs
    }catch(PDOException $e){
        echo 'Error amb la BDs: ' . $e->getMessage();
    }
?>

