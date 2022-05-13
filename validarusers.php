<?php
require_once "./connectardbb.php";
 // recupera los datos del envío POST
 $usuariIntroduit = $_POST['user'];
 $email = $_POST['mail'];
 if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
 }else{
    $nom = "null";
 }
 if(isset($_POST['cognom'])){
    $cognom = $_POST['cognom'];
 }else{
    $cognom = "null";
 }
 $pass = $_POST['pass'];
 $verPass = $_POST['verPass'];
 $horacreadacompte = date("Y-m-d H:i:s");   
 
$to      = $email;
$subject = "Correo de Confirmacion";
$message = "Hola ".$nom."\r\n"." Sigue este vinculo para activar tu cuenta"."\r\n\r\n"." http://tupagina.com/confirm.php?usuario=".$usuariIntroduit."&code=".$code."\r\n";
$headers = 'De: (tu correo )' . "\r\n".
'Dudas y/o sugerencias: info@eduhacks.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

 if(isset($usuariIntroduit)){
    $sql = 'SELECT mail FROM `users`';
    $usuaris = $db->query($sql);
    if($usuaris){
        $existeix = false;
        foreach ($usuaris as $fila) {
            if($email == $fila[0] ){
                    $existeix = true;
                    break;
                }
        }
        if($existeix == true){
            $missatge = "Usuari ja creat";
            echo "<script type='text/javascript'>
                    alert('$missatge');
                    window.location.href='./index.php';
                </script>";
            
            
        }else{
            $passwordintroduit = password_hash($pass, PASSWORD_DEFAULT);
            if($_POST['pass'] == $_POST['verPass']){
                $numAleatori = rand();
                $codiAleatori = hash("sha256",$numAleatori);
                $numPass = rand();
                $codiPass = hash("sha256",$numPass);
                $insert = "insert into users (mail, username, passHash, userFirstName, userLastName, creationDate, active, activationCode, resetPassCode) values ('$email','$usuariIntroduit','$passwordintroduit','$nom','$cognom','$horacreadacompte','0','$codiAleatori','$codiPass');";
                $provainsert = $db->query($insert);
                $missatge = "El usuari s ha creat correctament";
                echo "<script type='text/javascript'>
                    alert('$missatge');
                    window.location.href='./index.php';
                </script>";
                require_once "./enviarmail.php";
                //mail($to, $subject, $message, $headers);
               
            }else{
                $missatge = "Contrasenya incorrecte";
                echo "<script type='text/javascript'>
                    alert('$missatge');
                    window.location.href='./create-users.php'; 
                </script>";
            }
            
        }
    }
 }

?>