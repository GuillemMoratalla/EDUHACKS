<?php
//require_once "./connectardbb.php";
function buscarUsuari($user){
    require "./connectardbb.php";
    $sqluserID = 'SELECT iduser FROM users WHERE username = :usernameFind';
    $findName = $db->prepare($sqluserID);
    $findName->bindParam(':usernameFind',$user);
    $findName->execute();
    if($findName){
        foreach($findName as $fila){
            $nameid = $fila['iduser'];
        }
    }
    return $nameid;
}
function crearChallenge($title, $description, $url, $points, $urlName, $idUsuari,$flag){
    require "./connectardbb.php";
    $sql = "INSERT INTO ctf (`tittle`,`description`,`filePath`,`iduser`,`fileName`,`points`,`flag`) VALUES(:title,:descripcion,:urlh,:idUser,:urlN,:points,:flag)";
    $res=move_uploaded_file($_FILES['file']['tmp_name'],"./files/".$url);
    //$idUsuari = buscarUsuari($_SESSION['usuari']);
    
    if($res){
        $preparada = $db->prepare($sql);
        $preparada->execute(array(":title"=>$title,":descripcion"=>$description,":urlh"=>$url,":idUser"=>$idUsuari,":urlN"=>$urlName,":points"=>$points,":flag"=>$flag));
       
        $lastIDctf = $db->lastInsertId();
        return $lastIDctf;
    } 
}

function comprobarHashtag($hashtags) {
    require "./connectardbb.php";
    $sql = "SELECT * FROM hashtags";
    
    $obj = json_decode($hashtags, true);
    $hashtag = $db->query($sql);

    if($hashtag){
        foreach ($obj as $value) {
            $trobat=0; 
            $hashtag = $db->query($sql);
            foreach($hashtag as $fila){
                //Agregar hashtag a la lista de Hashtag/Repte
                if(($value['value']==$fila['name'])){ 
                    if($trobat==0){agregarHashtag($fila['id']); $trobat=1;} 
                }
            }
            //Crear nuevo hashtag y agregarlo
            if ($trobat==0) { crearHashtag($value['value']); }
        }
    }
}

function crearHashtag($hashtag) {
    require "./connectardbb.php";
    $sql = "INSERT INTO hashtags (name) VALUES(:hashtag)";
    $preparada = $db->prepare($sql);
    $preparada->execute(array(":hashtag"=>$hashtag));
    $checkHashtag = $db->lastInsertId();

    agregarHashtag($checkHashtag);
}

function agregarHashtag($hashtagID) {
    require "./connectardbb.php";
    //SELECCIONA EL ULTIMO CHALLENGE CREADO
    $sqlID = 'SELECT * FROM ctf ORDER BY idctf DESC LIMIT 1';
    $lastID = $db->prepare($sqlID);
    $lastID->execute();
    //$challengeID=0;
    if(isset($lastID)){
        foreach($lastID as $fila){
             $challengeID = $fila['idctf'];
        }
    }
    $sql = "INSERT INTO hashtagsctf (idHashtag,idctf) 
            VALUES(:hashtagID,:idctf)";
    
    $preparada = $db->prepare($sql);
    $preparada->execute(array(":hashtagID"=>$hashtagID,":idctf"=>$challengeID));
}

?>