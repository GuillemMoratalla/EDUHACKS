<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $correuDestinetari = $_POST['mail']; 
    //Configuració del servidor de Correu
    //Modificar a 0 per eliminar msg error
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    
    //Credencials del compte GMAIL
    $mail->Username = '';
    $mail->Password = '';

    //Dades del correu electrònic
    $mail->SetFrom('guillem.moratallac@educem.net','EDUHACKS');
    $mail->Subject = 'Benvingut a EDUHACKS!';
    $mail->MsgHTML('<a href="http://localhost/exercicis/ENTREGA%201/mailCheckAccount.php?code=' . $codiAleatori . '&mail=' . $correuDestinetari . '">Verifica Correu</a> ');
    
    //$mail->addAttachment("fitxer.pdf");
    
    //Destinatari
    $address = $correuDestinetari;
    $mail->AddAddress($address, 'Test');

    //Enviament
    $result = $mail->Send();
    if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
    }else{
        echo "Correu enviat";
    }

    $destinatario = $mail;

    $para  = $destinatario;