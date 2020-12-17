<?php  
    session_start();
    //odstranit po debugu !!!!!
    $_SESSION["idUcitel"] = 2;//odstranit po debugu !!!!!
        require_once "../../config.php";
        $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    //odstranit po debugu !!!!!
    if (isset($_POST["a"])) {
        $action = $_POST['a'];
        if ($action == "otazky") {
            $array = $_POST['array'];
        
            $ucitelID = $_SESSION['idUcitel'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`) VALUES ('$array','$ucitelID')");
            
            $idForm = mysqli_insert_id($spojeni);
            $idHodiny = $_POST['idHodiny'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`) VALUES ('$idForm','$idHodiny')");
        }
    }