<?php
function validarUsuario($usuarioLogin,$password){
    require_once "./connectardbb.php";
    $sql = 'SELECT passHash,active,iduser,username FROM users WHERE username=:user';
    $trobat = false;
    $usuario=NULL;
    $consulta = $db -> prepare($sql);
    $consulta->bindParam(':user',$usuarioLogin);
    $consulta->execute();
    if($consulta) {
        foreach($consulta as $element) {
            if (password_verify($password, $element['passHash']) AND $element['active'] == 1) {
                $usuario['iduser']=$element['iduser'];
                $usuario['username']=$element['username'];
                $trobat = true;
                break;
            }
        }
    if($trobat){
        /*$LastSignIn = date("y-m-d h:i:s");
        $consulta = "UPDATE users SET lastSignIn='$LastSignIn' WHERE username = '$usuari'";
        $consulta = $db->query($consulta);*/
        return $usuario;
    }
    if(!$trobat){
        $usuario['error']=1;
        echo "Contraseña introducida por el usuario: ". $password.'<br/>';
        //echo "Contraseña de la DB: ". $element['passHash'].'<br/>';
        echo "error pass incorrecte";
        header('Location:./index.php');
    }
    return $usuario;
    }
}
/*
 // recupera los datos del envío POST
 $usuari = $_POST['username'];
 $password = $_POST['pass'];

 $consulta = "select passHash,active,iduser from users where username = '$usuari'";


$trobat = false;

 $consulta = $db->query($consulta);
 if($consulta !== false) {
    
    foreach($consulta as $element) {
        if (password_verify($password, $element['passHash']) AND $element['active'] == 1) {
            $iduser=$element['iduser'];
            $trobat = true;
            break;
        }
    }
    if($trobat){
        $LastSignIn = date('Y\/m\/d G:i:s');
        $consulta = "UPDATE users SET lastSignIn='$LastSignIn' WHERE username = '$usuari';";
        $consulta = $db->query($consulta);
        session_start();
        $_SESSION['usuari'] = $usuari['username'];
        $_SESSION['idusuari'] = $iduser;
        header('Location:./main.php');
        exit;
    }else{
        echo "Contraseña introducida por el usuario: ". $password.'<br/>';
        //echo "Contraseña de la DB: ". $element['passHash'].'<br/>';
        echo "error pass incorrecte";
        header('Location:./index.php');
    }

 } else {
     echo "Estoy vacio";
 }
*/
?>