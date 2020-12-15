<?php   

    if(isset($_POST["odeslatDotaznik"])){
        $sql;
        $spojeni;
        mysqli_query($spojeni, $sql);

    }

    if (isset($_POST["a"])) {
        $action = $_POST['a'];
        if ($action == "otazky") {
            $array = $_POST['array'];
        
            $data = serialize($array);
            
            $ucitelID = $_SESSION['idUcitel'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`) VALUES ('$data','$ucitelID')");
            
            $idForm = mysqli_insert_id($spojeni);
            $idHodiny = $_POST['idHodiny'];

            mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`) VALUES ('$idForm','$idHodiny')");
        }
    }