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
                $casRozsahu = $_POST['rozsahCas'];
                $pouzitiRozsahu = $_POST['rozsahPouziti'];
                $cas = time();
                $cas += 60*$casRozsahu;
                $cas = date("Y-m-d H:i:s",$cas);
                $_SESSION['cas'] = $cas;
                
                $kod = generaceKodu(5);
                $dataKod = mysqli_query($spojeni, "SELECT * FROM `eval_formulare` WHERE `kod` = '$kod'");
                $_SESSION['kod'] = $kod;

                while(true) {
                    if (mysqli_num_rows($dataKod) == 0) {
                        if(isset($_POST['nazev'])) {
                            $nazev = $_POST['nazev'];
                            mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`,`nazev`) VALUES ('$array','$ucitelID','$nazev')");
                        } else {
                            mysqli_query($spojeni, "INSERT INTO eval_formulare_vzory (`otazka`,`idUcitel`) VALUES ('$array','$ucitelID')");
                        }
                                        
                        $idForm = mysqli_insert_id($spojeni);
            
                        mysqli_query($spojeni, "INSERT INTO eval_formulare (`idVzoru`, `idHodiny`, `kod`, `cas`, `pocet`) VALUES ('$idForm','$idHodiny','$kod','$cas','$pouzitiRozsahu')");
                        break;
                    } else {
                        $kod = generaceKodu(5);
                        $dataKod = mysqli_query($spojeni, "SELECT * FROM `eval_formulare` WHERE `kod` = '$kod'");
                        $_SESSION['kod'] = $kod;
                    }
                }
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

    function generaceKodu ($n) {
        $znaky = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kodString = '';
    
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($znaky) - 1);
            $kodString .= $znaky[$index];
        }
    
        return $kodString;
    }