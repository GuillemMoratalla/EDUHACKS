<?php 
if(!empty($_GET['repte'])){
    require "../connectardbb.php";
    $sqlctfid = 'SELECT * FROM ctf ORDER BY idctf';
    $idchallenge= array();
    $newctfID = $db->prepare($sqlctfid);
    $newctfID->execute();
    foreach($newctfID as $fila){
        $idchallenge[] = $fila;
    }
        do{
        // $newctfID->execute();
        $newID = rand(1, $newctfID->rowCount()-1);
    }while($idchallenge[$newID]['idctf'] == $_GET['repte']);
    header("Location: ../main.php?id=$newID");
    exit;      
}
else{
    header("../home.php");
}
 
?>