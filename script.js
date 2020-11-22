let textareaVyber = "<textarea name='podvyber' id='podvyber#*' cols='30' rows='2'></textarea>";
let formularText = "";
let formularVyber = "<div id='pridatVyber#'><button onclick='pridatDalsiVyber(#)'>Přídat další možnost k výběru</button><br><div>";
let formularHvezdy = "";
let formularLikeDislike = "";
let vyberFormular = "<div id='#'><h3>Otázka '#':</h3><textarea name='zadanaOtazka' id='otazka' cols='30' rows='4'></textarea><h3>Možnost odpovědi:</h3><input type='radio' name='volbaOdpovedi#' value='text' id='text#' onchange='moznostOdpovedi(#)'><label for='text'>Text</label><br><input type='radio' name='volbaOdpovedi#' value='anoNe' id='anoNe#' onchange='moznostOdpovedi(#)'><label for='anoNe'>Ano/Ne</label><br><input type='radio' name='volbaOdpovedi#' value='vyber' id='vyber#' onchange='moznostOdpovedi(#)'><label for='vyber'>Výběr</label><br><button id='odstranit#' onclick='odstranitOtazku(#)'>Odstranit tuto otázku</button><br></div>";
let i = 1;
let pocetOtazek = 0;
let z = 1;
let k = 1;

function pridatDalsiOtazku() {
    vyberFormularZmena = vyberFormular.replaceAll("#", i.toString());
    if (pocetOtazek > 0)
        document.getElementById(i-1).insertAdjacentHTML("afterEnd", vyberFormularZmena);
    else
        document.getElementById("vyberCelkovehoHodnoceniHodiny").insertAdjacentHTML("afterEnd", vyberFormularZmena);
    pocetOtazek++;
    i++;
}
function moznostOdpovedi(cislo) {  
    var prvky = document.getElementsByName('volbaOdpovedi' + cislo); 
        
    for(j = 0; j < prvky.length; j++) { 
        if(prvky[j].checked && prvky[j].value == "vyber"){
            formularVyberZmena = formularVyber.replaceAll("#", cislo.toString());
            document.getElementById(cislo).insertAdjacentHTML("beforeend", formularVyberZmena);
        }
        else if(document.getElementById("pridatVyber" + cislo) != null && prvky[j].value != "vyber"){
            document.getElementById("pridatVyber" + cislo).remove();
        } 
    } 
}
function odstranitOtazku(cislo){
    document.getElementById(cislo).remove();
    pocetOtazek--;
}
function pridatDalsiVyber(){

}