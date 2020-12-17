<?php
    require_once "../../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    session_start();

    if (isset($_POST["a"])) {
        $action = $_POST['a'];
        if ($action == "otazky") {
            $array = $_POST['array'];

            if(isset($_POST['nazev'])) {
                $nazev = $_POST['nazev'];
            } else {
                $nazev = "";
            }
        
            $ucitelID = $_SESSION['idUcitel'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`,`nazev`) VALUES ('$array','$ucitelID','$nazev')");
            
            $idForm = mysqli_insert_id($spojeni);
            $idHodiny = $_POST['idHodiny'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`) VALUES ('$idForm','$idHodiny')");
        }
    }