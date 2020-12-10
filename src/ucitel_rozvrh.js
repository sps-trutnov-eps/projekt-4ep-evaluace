var dny = ["Po", "Út", "St", "Čt", "Pá"];

function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    $("#potvrdit").click(function() {
        document.getElementById("popup").style.display = "none";
        var predmet = document.getElementById("predmet").value;         //  POTŘEBA UDĚLAT PHP NA ODESLÁNÍ S IDčkem POLE
        document.getElementById(id).innerHTML = predmet;
        //
    })
}

function generovatRozvrh() {
        var tyden = document.getElementById("sudyLichy").innerHTML;
        var pole = "";
        for (i = 0; i <= 4; i++) {
            pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th>";
            for (y = 1; y <= 9; y++) {
                pole += "<td id='"+ tyden + "_" + y + "_" + dny[i] + "' onclick=''></td>";          //          GENERACE ROZVRHU
            }
            pole += "</tr>";
        }
        document.getElementById("rozvrh").innerHTML = pole;
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

$(document).ready(function () {
    sudyLichy();
    generovatRozvrh();
    upravaRozvrhu();
})