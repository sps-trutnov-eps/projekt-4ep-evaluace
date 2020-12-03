var dny = ["Po", "Út", "St", "Čt", "Pá"];

//$(".sudyLichy").attr("id", "sudy");
function generovatRozvrh() {
    var pole = "";
    for (i = 0; i <= 4; i++) {
        pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th>";
        for (y = 1; y <= 9; y++) {
            pole += "<th id='"+ y + "_" + dny[i] + "' onclick=''></th>";
        }
        pole += "</tr>";
    }
    document.getElementById("rozvrh").innerHTML = pole;
}

function pridatHodinu(id) {
    document.getElementById(id).innerHTML = ":)";
}

$(document).ready(function () {
    //          ÚPRAVA
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

function generovatTemata() {
    
}