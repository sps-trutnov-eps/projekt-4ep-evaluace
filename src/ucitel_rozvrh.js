var dny = ["Po", "Út", "St", "Čt", "Pá"];

function generovatDny() {
    var pole = "";
    for (i = 0; i <= 4; i++) {
        pole += "<tr id='" + dny[i] + "'><th>" + dny[i] + "</th></tr>";
    }
    document.getElementById("rozvrh").innerHTML = pole;
}

function generovatRozvrh() {

}

function generovatTemata() {
    
}