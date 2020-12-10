<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Za to může Honza</title>
</head>
<body>
    <?php
    require_once "../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser,dbpass,dbname);
    session_start();
    //$_POST["něco"];
    //$formular = mysqli_query($spojeni, "SELECT * FROM databaze WHERE neco = 'neco'");
    //json_decode($formular);
    $data = '[
        {
            "typ": "otevrena",
            "text": "Otevřená otázka"
        },
        {
            "typ": "uzavrena",
            "text": "Uzavřená otázka",
            "moznosti": [
                { "text": "První možnost" },
                { "text": "Druhá možnost" },
                { "text": "Třetí možnost" }
            ]
        }
    ]';
    
    $objekt = json_decode($data);    
    foreach($objekt as $otazka){
        switch($otazka->typ){
            case "otevrena":
                $nadpis = $otazka->text;
                echo $nadpis;
                break;
            case "hvezdicky":
                $nadpis = $otazka->text;
                echo $nadpis;
                break;
            case "moznosti":
                $nadpis = $otazka->text;
                echo $nadpis;
                break;
            case "bezHodnoceni";
                $nadpis = $otazka->text;
                echo $nadpis;
                break;
            default:
                /*Honzo nefunguje ti to!*/
        }
    }
    ?>
</body>
</html>