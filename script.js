let textareaVyber = "<div id='podvyber*' class='podvyber#'><input type='text' name='podvyber#' cols='30' rows='2'></textarea><button onclick='odstranitPodvyber(*)'>Odstranit možnost k výběru</button><br></div>";
let formularText = "";
let formularVyber = "<div id='pridatVyber#'><button onclick='pridatDalsiVyber(#)'>Přídat další možnost k výběru</button><br><div>";
let formularHvezdy = "";
let vyberpoctuvybranychpododpovedi = "<input type='number' id='vyberpoctuvybranychpododpovedi#' onkeydown='return false' min ='1' max='1'><label >Maximální počet zaškrtnutelných</label>";
let vyberFormular = "<div id='#'><h3>Otázka '#':</h3><textarea name='zadanaOtazka' id='otazka#' cols='30' rows='4'></textarea><h3>Možnost odpovědi:</h3><input type='radio' name='volbaOdpovedi#' value='text' id='text#' onchange='moznostOdpovedi(#)'><label for='text'>Text</label><br><input type='radio' name='volbaOdpovedi#' value='anoNe' id='anoNe#' onchange='moznostOdpovedi(#)'><label for='anoNe'>Ano/Ne</label><br><input type='radio' name='volbaOdpovedi#' value='vyber' id='vyber#' onchange='moznostOdpovedi(#)'><label for='vyber'>Výběr</label><br><button id='odstranit#' onclick='odstranitOtazku(#)'>Odstranit tuto otázku</button><br></div>";
let i = 1;
let pocetOtazek = 0;
let z = 1;
let k = 1;
let pocetpodvyber = 0;
let formularOtazky = document.getElementById('formularOtazky');

formularOtazky.addEventListener('submit', e => {
	e.preventDefault();

	zjistitHodnoty();
});

function zjistitHodnoty() {
    var checkRadio = document.querySelector('input[name="formularVyberFormulare"]:checked');
    var otazky = [];

    otazky[otazky.length] = checkRadio.value;

    var t = 1;
    do {
        var textOtazky = document.getElementById('otazka'+ t);
        var typOtazky = document.querySelector('input[name="volbaOdpovedi' + t + '"]:checked');

        otazky[otazky.length] = textOtazky.value;

        /*if (typOtazky.value == "vyber") {
            var data = document.querySelectorAll('.podvyber' + t);
            
        } else*/
            otazky[otazky.length] = typOtazky.value;

        t++;
    } while (t < pocetOtazek + 1);

    console.log(otazky);
}

function pridatDalsiOtazku() {
    vyberFormularZmena = vyberFormular.replaceAll("#", i.toString());
    if (pocetOtazek > 0)
        document.getElementById(i-1).insertAdjacentHTML("afterEnd", vyberFormularZmena);
    else
        document.getElementById("otazky").insertAdjacentHTML("beforeend", vyberFormularZmena);
    pocetOtazek++;
    i++;
}
function moznostOdpovedi(cislo) {  
    var prvky = document.getElementsByName('volbaOdpovedi' + cislo); 
        
    for(j = 0; j < prvky.length; j++) { 
        if(prvky[j].checked && prvky[j].value == "vyber"){
            formularVyberZmena = formularVyber.replaceAll("#", cislo.toString());
            document.getElementById("odstranit" + cislo).insertAdjacentHTML("beforebegin", formularVyberZmena);
        }
        else if(document.getElementById("pridatVyber" + cislo) != null && prvky[j].value != "vyber"){
            document.getElementById("pridatVyber" + cislo).remove();
            var prvkypodvyberu = document.getElementsByClassName("podvyber" + cislo);
            if(prvkypodvyberu.length > 0)
                for(jj = prvkypodvyberu.length-1; jj >= 0; jj--){
                    document.getElementById(prvkypodvyberu[jj].id).remove();
                }
        } 
    } 
}
function odstranitOtazku(cislo){
    document.getElementById(cislo).remove();
    pocetOtazek--;
}
function pridatDalsiVyber(cislo){
    if(document.getElementsByName("podvyber" + cislo).length == 0){
        text = vyberpoctuvybranychpododpovedi.replaceAll("#", cislo.toString());
        document.getElementById("pridatVyber" + cislo).insertAdjacentHTML("beforebegin", text);
    }else{
        document.getElementById("vyberpoctuvybranychpododpovedi" + cislo).setAttribute("max",document.getElementsByName("podvyber" + cislo).length+1);
    }
    var prvkyPodvyberu = document.getElementsByName('podvyber' + pocetpodvyber); 
    textareaVyberZmena = textareaVyber.replaceAll("#", cislo.toString());
    textareaVyberZmena = textareaVyberZmena.replaceAll("*", pocetpodvyber.toString());
    pocetpodvyber++;
    document.getElementById("pridatVyber" + cislo).insertAdjacentHTML("beforebegin", textareaVyberZmena);
}
function odstranitPodvyber(cislo){
    document.getElementById("podvyber" + cislo).remove();
    pocetpodvyber--;
    if(document.getElementsByClassName(document.getElementById("podvyber" + cislo).className).length == 0){
        document.getElementById("vyberpoctuvybranychpododpovedi" + cislo).remove();
    }else{
        document.getElementById("vyberpoctuvybranychpododpovedi" + cislo).setAttribute("max",document.getElementsByName("podvyber" + cislo).length+1);
    }
}