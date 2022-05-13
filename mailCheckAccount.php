
<?php

if($_SERVER["REQUEST_METHOD"]=="GET"){
    require_once "./connectardbb.php";

    $correo = $_GET['mail']; 
    $codigo = $_GET['code']; 

    $sql = 'SELECT activationCode as codi ,mail FROM users where activationCode = :codi and mail = :mail;';
    $activar = $db->prepare($sql);
    $activar->execute(array(':codi' => $codigo, ':mail' => $correo));

    $dataActivat = date('Y\/m\/d G:i:s');

    $fila = $activar->fetch(PDO::FETCH_ASSOC);

    if(isset($fila['mail']) && isset($fila['codi'])){

        $update = 'UPDATE users SET active=1, activationDate = :dataActivat WHERE activationCode = :codi;';
        $activar = $db->prepare($update);
        $activar->execute(array(':codi' =>  $fila['codi'], ':dataActivat' => $dataActivat));
    }



}

header("Location: index.php");

?>