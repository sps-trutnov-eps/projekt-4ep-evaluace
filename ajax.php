<?php
    require_once "../../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    session_start();

    if (isset($_POST["a"])) {
        $action = $_POST['a'];
        if ($action == "otazky") {
            $idHodiny = $_POST['idHodiny'];
            if($idHodiny == "") {
                echo "NeniVybranaHodina";
            } else {
                $array = $_POST['array'];
                $ucitelID = $_SESSION['idUcitel'];
                if(isset($_POST['nazev'])) {
                    $nazev = $_POST['nazev'];
                    mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`,`nazev`) VALUES ('$array','$ucitelID','$nazev')");
                } else {
                    mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`) VALUES ('$array','$ucitelID')");
                }
                                
                $idForm = mysqli_insert_id($spojeni);
    
                mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`) VALUES ('$idForm','$idHodiny')");
            }
        }
    }