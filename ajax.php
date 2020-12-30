<?php  
    session_start();
    require_once "../../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
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
                    mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitele`,`nazev`) VALUES ('$array','$ucitelID','$nazev')");
                } else {
                    mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitele`) VALUES ('$array','$ucitelID')");
                }
                                
                $idForm = mysqli_insert_id($spojeni);
    
                mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`) VALUES ('$idForm','$idHodiny')");
            }
        }
    }
    if(isset($_POST["formularID"])){
        $formID = $_POST["formularID"];
        $sql = "SELECT * FROM eval_formulare_vzory WHERE id=$formID";
        $data = mysqli_query($spojeni, $sql);
        $data = mysqli_fetch_assoc($data);
        echo($data["otazka"]);
    }