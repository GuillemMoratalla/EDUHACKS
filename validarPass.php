<?php

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    if($_SERVER["REQUEST_METHOD"]!="POST"){
        header("Location: login.php");
    }else{
        require_once "./connectardbb.php";
    }

    if(isset($_POST['correu'])){

        $mail = $_POST['correu'];
        $sql = 'SELECT resetPassCode as codi FROM users where mail = :mail;';
        $obtenirCodi = $db->prepare($sql);
        $obtenirCodi->execute(array(':mail' => $mail));

        $fila = $obtenirCodi->fetch(PDO::FETCH_ASSOC);

        enviarCorreo($fila['codi'],$mail);

    }

    function enviarCorreo ($codigo,$correo){

        $mail = new PHPMailer();
        $mail->IsSMTP();
 
        //Configuració del servidor de Correu
        //Modificar a 0 per eliminar msg error
        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        
        //Credencials del compte GMAIL
        $mail->Username = 'guillem.moratallac@educem.net';
        $mail->Password = '4837B@2122';

        //Dades del correu electrònic
        $mail->SetFrom('joshua.delvallec@educem.net','EDUHACKS');
        $mail->Subject = 'Reset Password EDUHACKS';
        $mail->MsgHTML('<a href="http://localhost/exercicis/ENTREGA%201/newPassMail.php?code=' . $codigo . '&mail=' . $correo . '">Canviar Pass</a> ');
        
        //$mail->addAttachment("fitxer.pdf");
        
        //Destinatari
        $address = $correo;
        $mail->AddAddress($address, 'Test');


        //Enviament
        $result = $mail->Send();
        if(!$result){
            echo 'Error: ' . $mail->ErrorInfo;
        }	
        
        $missatge = "Correu enviat Correctament";
        echo "<script type='text/javascript'>
        alert('$missatge');
        window.location.href='./index.php';
        </script>";


    }
    

          
?>