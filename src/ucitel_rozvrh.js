function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    $("#potvrdit").click(function() {
        document.getElementById("popup").style.display = "none";
        var predmet = document.getElementById("predmet").value;         //  POTŘEBA UDĚLAT PHP NA ODESLÁNÍ S IDčkem POLE
        document.getElementById(id).innerHTML = predmet;
        //
    })
}

$(document).ready(function () {
    //          GENERACE ROZVRHU
    var dny = ["Po", "Út", "St", "Čt", "Pá"];
    var pole = "";
    for (i = 0; i <= 4; i++) {
        pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th>";
        for (y = 1; y <= 9; y++) {
            pole += "<th id='"+ y + "_" + dny[i] + "' onclick=''></th>";
        }
        pole += "</tr>";
    }
    document.getElementById("rozvrh").innerHTML = pole;

    //          ÚPRAVA ROZVRHU
    $("#upravy").click(function () {
        if (document.getElementById("upravy").innerHTML == "Upravit") {
            $("#upravy").text("Zastavit úpravy");
            $("th").attr("onclick", "pridatHodinu(this.id)");
        } else {
            $("#upravy").text("Upravit");   
            $("th").attr("onclick", "");
        }
    })
    

    //          SUDÝ/LICHÝ TÝDEN
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
        $("#sudyLichy").attr("name", "lichy");
    }
    else {
        document.getElementById("sudyLichy").innerHTML = sudy;
        $("#sudyLichy").attr("name", "sudy");
    }

    $("#sudyLichy").click(function () {
            if (document.getElementById("sudyLichy").innerHTML == lichy) {
                document.getElementById("sudyLichy").innerHTML = sudy;
                $("#sudyLichy").attr("name", "sudy");
            }
            else {
                document.getElementById("sudyLichy").innerHTML = lichy;
                $("#sudyLichy").attr("name", "lichy");
            }
    })
})