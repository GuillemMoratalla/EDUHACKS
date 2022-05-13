<?php
if (!isset($_COOKIE[session_name()])) {
    header("Location: index.php");
    exit;
} else {
    session_start();
    if (!isset($_SESSION['usuari'])) {
        header("Location: ./logout.php");
        exit;
    }
}
$correcto = false;
    require_once "./libCTF/cargarCTF.php";
    $iduser = quienSoy($_SESSION['idusuari']);
    $challenge = array();
    if (isset($_GET['id'])) {
    $challenge = buscarCtf($_GET['id']);
    }else{
        $challenge = buscarUltimoCtfSubido();
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["flag"])) {
            $flagPOST = filter_input(INPUT_POST, 'flag');
            $correcto = ComprovarFlag($flagPOST,$challenge['idctf']);
            if($correcto == true){sumarPuntos($challenge['idctf'],$_SESSION['idusuari']);}
        }
    }
    //if(isset($challenge))$hashtags = buscarHashtags($challenge['idctf']);
?>
<html>
<style>
.body{

    /*background-image: url("https://img.freepik.com/foto-gratis/pared-habitacion-circulo-luz-laser-lampara-fluorescente-esferica-pisos-paredes-estilo-tecnologico-3d_357568-3528.jpg?w=996");*/
    /*background-color:#3D3D3D;*/
    /*background-color:rgb(0,0,0,0.8);*/
    background-color:black;
    background-repeat: no-repeat;
	background-size: 100% 100%;
    height:100%;
    width:100%;
}

.boton{

    border: 1px solid #2e518b; /*anchura, estilo y color borde*/
    padding: 10px; /*espacio alrededor texto*/
    background-color: #2e518b; /*color botón*/
    color: #ffffff; /*color texto*/
    text-decoration: none; /*decoración texto*/
    text-transform: uppercase; /*capitalización texto*/
    font-family: 'Helvetica', sans-serif; /*tipografía texto*/
    border-radius: 50px; /*bordes redondos*/

}

.titol{
    margin-left:25%;
    font-family: Arial, Helvetica, sans-serif;
    font-size:50px;
    margin-top:1%;
    color: #F10A7E;
    
}

.idk{
    color:white;
    text-align:center;
}

.challenges{
    margin-left:25%;
    font-family: Arial, Helvetica, sans-serif;
    font-size:50px;
    color: #F10A7E;
    margin-top:30%;
}

.col1{
    width:40%;
    height:50%;
    margin-left:10%;
    float:left;
    border-style:inset;
    border-color:#F10A7E;
    background-color:rgb(0,0,0,0.8);
    font-family: Arial, Helvetica, sans-serif;
    text-align:center;
}
.col2{
    width:40%;
    height:50%;
    margin-left:6%;
    float:left;
    font-family: Arial, Helvetica, sans-serif;
}

.ctfs{
    width:70%;
    margin-left:15%;
    font-family: Arial, Helvetica, sans-serif;
    font-size:20px;
    text-align:center;
}

.clasi{
    text-align: center;
    width:60%;
    height:100%;
    background-color:rgb(0,0,0,0.8);
    font-family: Arial, Helvetica, sans-serif;
    border-style: outset;
    border-color:#F10A7E;
}

th{
    color: #F10A7E;
}

td{
    color:white;
    text-align:center;
}



</style>
<body class="body">
    <h1 class="titol">BENVINGUT EDUHACKS</h1>
    <div class="col1">
            <h4 class="idk">
                <?php 
                if(isset($challenge) && $challenge!=null){ //aqui estan los datos del challenge seleccionado

                    //echo $challenge['idctf'];
                    echo "Tittle: ";
                    echo $challenge['tittle'];
                    echo "<br>";
                    echo "Description: ";
                    echo $challenge['description'];
                    echo "<br>";
                    echo "Points: ";
                    echo $challenge['points'];
                    echo "<br>";
                    echo "file: ";
                
                    echo "<a href=./files/".$challenge['filePath'].">".$challenge['fileName']."</a>";
                    echo "<br>";
                    #echo $challenge['tittle']."/".$challenge['description']."/".$challenge['iduser']."/".$challenge['points']."/<a href=./files/".$challenge['filePath'].">".$challenge['fileName']."</a>";
                    #echo $challenge['description']; 
                    ##echo $challenge['iduser'];
                    #echo $challenge['points'];
                    #echo "<a href=./files/".$challenge['filePath'].">".$challenge['fileName']."</a>";
                    //showHashtags($hashtags);
                    if($correcto = true){echo "RESUELTO";};
                }
                ?>
            </h4>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color:#F10A7E;">FLAG</h3>
                <input type="text" class="form-control" name="flag" required>
            </div>
            <br>
            <button type="submit" class="boton">Provar Solucio</button>
            </form>
            <br>
            <div class="form-group">
                <a class="boton" href="./nuevoChallenge.php">Nou Repte</a>
                <a class="boton" href="./libCTF/aleatorioCTF.php?repte=<?php echo $challenge['idctf'];?>" >Repte Aleatori</a>
                <a class="boton" href="./logout.php">Salir</a>
            </div>
    </div>
    <div class="col2">
                <table class="clasi">
                    <tr>
                        <th>Jugador</th>
                        <th>Puntos</th>
                    </tr>
                    <td><?php tablaJugadores(); ?></td>
                </table>
    </div> 
    <h3 class="challenges">TODOS LOS CHALLENGES</h3>
    foreach
    <div class="ctfs">
        <?php 
        listaCTFS($challenge['idctf']);
        
        ?>
    </div>
    
</body>
</html>