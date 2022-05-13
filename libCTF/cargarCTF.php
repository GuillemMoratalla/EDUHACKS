<?php
function quienSoy($nombre){

}
function ComprovarFlag($flag,$idctf){
    require "./connectardbb.php";
    $sqlRespuest = 'SELECT flag FROM ctf WHERE idctf = :idctf';
    $correcto = false;
    $findFlag = $db -> prepare($sqlRespuest);
    $findFlag->bindParam(':idctf',$idctf);
    $findFlag->execute();
    if($findFlag){
        foreach($findFlag as $fila){
            if($fila['flag'] == $flag){
                $correcto = true;
            }
        }
    }
    return $correcto;
}
function sumarPuntos($idctf,$idusuario){
    require "./connectardbb.php";
    $sqlRespuest = 'SELECT points FROM ctf WHERE idctf = :idctf';
    $findFlag = $db -> prepare($sqlRespuest);
    $findFlag->bindParam(':idctf',$idctf);
    $findFlag->execute();
    if($findFlag){
        foreach($findFlag as $fila){
            $puntazos = $fila['points'];//12 para españa si eurovision es justo
        }
        $sqlRespuest = 'UPDATE users SET points=points+:points WHERE iduser=:iduser';
        $sumarPuntos = $db -> prepare($sqlRespuest);
        $sumarPuntos ->bindParam(':points',$puntazos);
        $sumarPuntos ->bindParam(':iduser',$idusuario);
        $sumarPuntos -> execute();
    }

}
function tablaJugadores(){
    require "./connectardbb.php";
    $sqlRespuest = 'SELECT username,points FROM users ORDER BY points DESC';
    $list = $db -> prepare($sqlRespuest);
    $list->execute();
    if($list){
        foreach($list as $fila){
            echo"<tr><td>".$fila['username']."</td>";
            echo"<td>".$fila['points']."</td></tr>";
        }
    }
}
function buscarCtf($idChallenge){
    require "./connectardbb.php";
    $sqlID = 'SELECT * FROM ctf WHERE idctf= :idctf';
    $ctf = array();
    $findID = $db->prepare($sqlID);
    $findID->bindParam(':idctf', $idChallenge);
    $findID->execute();
    if($findID){
        foreach($findID as $fila){
            if($fila['idctf'] == $idChallenge){
                $ctf = $fila;
            }
        }
    }
    return $ctf; 
}

function buscarUltimoCtfSubido(){
    require "./connectardbb.php";
    $sqlID = 'SELECT * FROM ctf ORDER BY idctf DESC LIMIT 1';
    $challengeUltim=[];
    $lastID = $db->prepare($sqlID);
    $lastID->execute();
    if($lastID){
        foreach($lastID as $fila){
            $challengeUltim = $fila;
        }
        return $challengeUltim;
    }
} 
function buscarHashtags($idctf){
    require "./connectardbb.php";
    $sqlHashtag = 'SELECT * FROM `hashtagsctf` WHERE idctf = :idctf';
    //$hastags = array();
    $checkCTf = $db->prepare($sqlHashtag);
    $checkCtf->execute(array(':idctf'=>$idctf));
    if($checkCtf->rowCount()>0){
        foreach($checkCtf as $fila){
            $hastags = $fila['idHashtag'];
        }
        return $hastags;
    }
}
function showHashtags($hashtag){
    require "./connectardbb.php";
    if($hashtag){
        foreach($hashtag as $hash){
            $sqlHashtagsId = 'SELECT nom FROM hashtags WHERE id = :hashtagID';
            $sqlHashtag = $db->prepare($sqlHashtagsId);
            $sqlHashtag->bindParam(':hashtagID', $hash);
            $sqlHashtag->execute();
            foreach($sqlHashtag as $fila){
                echo '#'.$fila['nom']." ";
            }
        }
    }
}
function listaCTFS($idChallenge){
    require "./connectardbb.php";
   
    $sqlRequest = 'SELECT * FROM ctf WHERE idctf!=:idctf ORDER BY idctf DESC';
    $request = $db->prepare($sqlRequest);
    $request->execute(array(':idctf'=>$idChallenge));
    if($request){
        foreach($request as $fila){
           
            echo "
                <a href='./main.php?id=".$fila['idctf']."'>
                <div style='border:white 2px solid;float:left;height:45%;width:45%; margin-left:2%;margin-top:3%;background-image: url(https://img.freepik.com/foto-gratis/pared-habitacion-circulo-luz-laser-lampara-fluorescente-esferica-pisos-paredes-estilo-tecnologico-3d_357568-3530.jpg?w=996);font-size:30px;color:#065E9B;'>
                    <div >
                        <h6 style='word-wrap: break-word;'>". $fila['tittle']."</h6>
                        <p id='user'>".usuarioCreadorPersonal($fila['iduser'])."</p>
                        <p id='date'>".$fila["relaseDate"]."</p>
                    </div>
                </div>
                </a>";  
        }
    }
}
function usuarioCreadorPersonal($idCreador){
    require "./connectardbb.php";
    $name="User";
    $sqluserID = 'SELECT username FROM users WHERE iduser = :idCreador';
    $findName = $db->prepare($sqluserID);
    $findName->bindParam(':idCreador',$idCreador);
    $findName->execute();
    if($findName){
        foreach($findName as $fila){
            $name = $fila['username'];
        }
    }
    return $name;
}
?>