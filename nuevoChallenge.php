<?php
if (!isset($_COOKIE[session_name()])) {
    header("Location: index.php");
    exit;
} else {
    session_start();
    if (!isset($_SESSION['usuari'])) {
        header("Location: ../logout.php");
        exit;
    }
}
require ("./libCTF/subirCTF.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["title"]) && isset($_FILES["file"])) {
            $uniqueName=hash('md4',(time().rand(100,999). $_FILES['file']['name']),false);
            $originalName=$_FILES['file']['name'];
            $titlePOST = filter_input(INPUT_POST, 'title');
            $descriptionPOST = filter_input(INPUT_POST, 'description');
            $pointsPOST = filter_input(INPUT_POST, 'points');
            $tagsPOST = filter_input(INPUT_POST, 'tags');
            $flagPOST = filter_input(INPUT_POST, 'flag');
            //$archivoPOST = filter_input(INPUT_POST, 'file');
            $idchallenge = crearChallenge($titlePOST, $descriptionPOST,$uniqueName,$pointsPOST,$originalName,$_SESSION['idusuari'],$flagPOST);//flata pasar usuari id o algo per enregistrar el creador
            comprobarHashtag($tagsPOST);
            header("Location: ./main.php?id=$idchallenge");
            exit;
        }
    }
?>
<html>
<header>
    <meta charset="UTF-8" />
    <meta name="author" content="Guillem Moratalla" />
    <title>Eduhacks</title>
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</header>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" style="width: 46rem;">
        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Nou Repte</h3>
        <div class="form-outline mb-4">
            <input type="text" class="form-control" name="title" required>
            <label for="inputPasswordNew">Títol</label>
        </div>
        <div class="form-outline mb-4">
            <textarea class="form-control" name="description" rows="2"></textarea>
            <label for="inputPasswordNewVerify">Descripció</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control" name="flag"></textarea>
            <label for="inputPasswordNewVerify">Flag (Solucio)</label>
        </div>
        <div class="form-outline mb-4">
            <input type="number" class="form-control" name="points" rows="2"></textarea>
            <label for="inputPasswordNewVerify">Puntuació</label>
        </div>
        <div class="form-outline mb-4">
            <input name='tags' value='Eduhacks' class="form-control">
                        
            <label for="inputPasswordNewVerify">Hashtags</label>
        </div>
        <div class="form-outline mb-4">
            <input type="file" class="form-control" name="file" required>
            <label for="inputPasswordNewVerify">Repte</label>
        </div>
        <div class="pt-1 mb-4">
        <button type="submit" class="btn btn-primary">Confirmar</button>
            <a href="./main.php"><button type="button" class="btn btn-danger">Cancelar</button></a> 
            </div>
        </form>
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>
        // The DOM element you wish to replace with Tagify
        var input = document.querySelector('input[name=tags]');

        // initialize Tagify on the above input node reference
        new Tagify(input)
    </script>
</html>