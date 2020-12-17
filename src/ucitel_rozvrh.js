var dny = ["Po", "Út", "St", "Čt", "Pá"];

function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    $("#potvrdit").click(function() {
        document.getElementById("popup").style.display = "none";
        var predmet = document.getElementById("predmet").value;
        var trida = document.getElementById("trida").value;
        var skupina = document.getElementById("skupina").value;
        var skolniHodina = id;
        var datum;      //DOPLNIT DATUM!!!!!!!!!!!!!!!!!!!!

        if (predmet == "")
            alert("Nevyplnil/a jste všechny údaje.");
        else if (trida == "")
            alert("Nevyplnil/a jste všechny údaje.");
        else if (skupina == "")
            alert("Nevyplnil/a jste všechny údaje.");
        else
            $.ajax(
                {
                    type: "POST",
                    url: "ucitel_odeslaniDB.php",
                    data: {
                        predmet: predmet,
                        trida: trida,
                        skupina: skupina,
                        skolniHodina: skolniHodina,
                        datum: datum
                    },
                    success: function() {
                    },
                    error: function() {
                        alert("Při zpracování dotazu došlo k neočekávané chybě.");
                    }
                }
            );
    })
}

function generovatRozvrh() {
        var tyden = document.getElementById("sudyLichy").innerHTML;
        var pole = "";
        for (i = 0; i <= 4; i++) {
            pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th>";
            for (y = 1; y <= 9; y++) {
                pole += "<td id='"+ tyden + "_" + y + "_" + dny[i] + "' onload='vlozeniHodinDoRozvrhu("+ tyden + "_" + y + "_" + dny[i] + ")' onclick=''></td>";          //  GENERACE ROZVRHU
            }
            pole += "</tr>";
        }
        document.getElementById("rozvrh").innerHTML = pole;
}

function vlozeniHodinDoRozvrhu(skolniHodina) { //ZATÍM NEFUNKČNÍ!!!!!!!!!!!!!!!!!!!!!!!!
    $.ajax(
        {
            type: "LOAD",
            url: "ucitel_vlozeniHodin.php",
            success: function(data) {
                let odpoved = JSON.parse(data)["data"];
                let vlozeni = "";
                for(let i in odpoved)
                    vlozeni += "<div>" + odpoved[i]["predmet"] + "</div><div>" + odpoved[i]["trida"] + "</div><div>" + odpoved[i]["skupina"] + "</div>";

                document.getElementById(skolniHodina).innerHTML = vlozeni;
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
    );
}

function sudyLichy() {
    var datum = new Date();
    function getWeekOfMonth(datum) {
        let upraveneDatum = datum.getDate()+datum.getDay();
        let prefixes = ['0', '1', '2', '3', '4', '5'];
        return (parseInt(prefixes[0 | upraveneDatum / 7])+1);
    }

    var lichy = "Lichý";
    var sudy = "Sudý";
    if (getWeekOfMonth(datum) / 2 != 0) {
        document.getElementById("sudyLichy").innerHTML = lichy;
    }
    else {
        document.getElementById("sudyLichy").innerHTML = sudy;                                      //          SUDÝ/LICHÝ TÝDEN
    }

    $("#sudyLichy").click(function () {
            if (document.getElementById("sudyLichy").innerHTML == lichy) {
                document.getElementById("sudyLichy").innerHTML = sudy;
                generovatRozvrh();
            }
            else {
                document.getElementById("sudyLichy").innerHTML = lichy;
                generovatRozvrh();
            }
    })
}

function upravaRozvrhu() {
    $("#upravy").click(function () {
        if (document.getElementById("upravy").innerHTML == "Upravit") {
            $("#upravy").text("Zastavit úpravy");
            $("td").attr("onclick", "pridatHodinu(this.id)");                                      //          ÚPRAVA ROZVRHU
        } else {
            $("#upravy").text("Upravit");   
            $("td").attr("onclick", "");
        }
    })
}

function dataProPopupOkenko() {
    $.ajax(
        {
            type: "LOAD",
            url: "ucitel_popup.php",
            success: function(data) {
                let odpoved1 = JSON.parse(data)["data1"];
                let odpoved2 = JSON.parse(data)["data2"];
                
                let predmety = "<option value='' selected disabled hidden>Vyberte předmět</option>";
                for(let i in odpoved1)
                    predmety += "<option value=" + odpoved1[i]["id"] + ">" + odpoved1[i]["nazev"] + "</option>";

                let tridy = "<option value='' selected disabled hidden>Vyberte třídu</option>";
                for(let i in odpoved2)
                    tridy += "<option value=" + odpoved2[i]["id"] + ">" + odpoved2[i]["nazev"] + "</option>";
    
                $("#predmet").html(predmety);
                $("#trida").html(tridy);
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
    );
}

$(document).ready(function () {
    sudyLichy();
    generovatRozvrh();
    upravaRozvrhu();
    dataProPopupOkenko();
});