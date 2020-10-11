let formularAnoNe = "";
let formularText = "";
let formularVyber = "";
let formularHvezdy = "";
let formularLikeDislike = "";
let vyberFormular = "<div id='#'><h3>Otázka '#':</h3><textarea name='zadanaOtazka' id='otazka' cols='30' rows='4'></textarea><h3>Možnost odpovědi:</h3><input type='radio' name='volbaOdpovedi' value='text' id='text'><label for='text'>Text</label><br><input type='radio' name='volbaOdpovedi' value='anoNe' id='anoNe'><label for='anoNe'>Ano/Ne</label><br><input type='radio' name='volbaOdpovedi' value='vyber' id='vyber'><label for='vyber'>Výběr</label><br></div>";
let i = 1;

function pridatDalsiOtazku(){
    vyberFormularZmena = vyberFormular.replaceAll("#",i.toString());
    let j = i-1;
    if(j>0)
        document.getElementById(j).insertAdjacentHTML("afterEnd",vyberFormularZmena);
    else
        document.getElementById("vyberCelkovehoHodnoceniHodiny").insertAdjacentHTML("afterEnd",vyberFormularZmena);
    i++;
}