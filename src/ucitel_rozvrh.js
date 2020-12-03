var dny = ["Po", "Út", "St", "Čt", "Pá"];

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
    $("#upravy").click(function () {
        if (document.getElementById("upravy").innerHTML == "Upravit") {
            $("#upravy").text("Zastavit úpravy");
            $("th").attr("onclick", "pridatHodinu(this.id)");

        } else {
            $("#upravy").text("Upravit");   
            $("th").attr("onclick", "");
        }
    })
})

function generovatTemata() {
    
}