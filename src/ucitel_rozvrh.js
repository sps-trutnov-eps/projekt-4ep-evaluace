var dny = ["Po", "Út", "St", "Čt", "Pá"];

function generovatRozvrh() {
    var pole = "";
    for (i = 0; i <= 4; i++) {
        pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th>";
        for (y = 1; y <= 9; y++) {
            pole += "<th id='"+ y + "_" + dny[i] + "' onclick='pridatHodinu(this.id)'></th>";
        }
        pole += "</tr>";
    }
    document.getElementById("rozvrh").innerHTML = pole;
}

function pridatHodinu(id) {
    $("#upravy").addEventListener("click", function () {
        document.getElementById(id).innerHTML = ":)"; //dodělat jquery
    })
}

function generovatTemata() {
    
}