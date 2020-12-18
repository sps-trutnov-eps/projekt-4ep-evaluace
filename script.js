let textareaVyber = "<div id='podvyber*' class='podvyber#'><input type='text' name='podvyber#' cols='30' rows='2'></textarea><button onclick='odstranitPodvyber(*)'>Odstranit možnost k výběru</button><br></div>";
let formularText = "";
let formularVyber = "<div id='pridatVyber#'><button type='button'  onclick='pridatDalsiVyber(#)'>Přídat další možnost k výběru</button><br><div>";
let formularHvezdy = "";
let vyberpoctuvybranychpododpovedi = "<div id='vyberpoctuvybranychpododpovedi#'><input type='number' id='inputvyberucisla#' onclick='return false' onkeydown='return false' min ='0' max='1'><label >Maximální počet zaškrtnutelných</label></div>";
let vyberFormular = "<div id='#'class='prvkyOtazekDIV'><h3>Otázka:</h3><textarea name='zadanaOtazka' id='otazka#' cols='30' rows='4'></textarea><h3>Možnost odpovědi:</h3><input type='radio' name='volbaOdpovedi#' value='text' id='text#' onchange='moznostOdpovedi(#,false)'><label for='text'>Text</label><br><input type='radio' name='volbaOdpovedi#' value='anoNe' id='anoNe#' onchange='moznostOdpovedi(#,false)'><label for='anoNe'>Ano/Ne</label><br><input type='radio' name='volbaOdpovedi#' value='vyber' id='vyber#' onchange='moznostOdpovedi(#,false)'><label for='vyber'>Výběr</label><br><button id='odstranit#' onclick='odstranitOtazku(#)'>Odstranit tuto otázku</button><br></div>";
let i = 1;
let pocetOtazek = 0;
let z = 1;
let k = 1;
let pocetpodvyber = 0;
let formularOtazky = document.getElementById('formularOtazky');
window.addEventListener("load", nastavitDatumyUVyberuDatumu());
window.onload = (event) => {
    zmenacasu();
  };
formularOtazky.addEventListener('submit', e => {
    e.preventDefault();

    zjistitHodnoty();
});

function zjistitHodnoty() {
    var checkRadio = document.querySelector('input[name="formularVyberFormulare"]:checked');
    var otazky = '{"moznostHodnoceni": "' + checkRadio.value + '", "otazky": [';

    var t = 1;
    do {
        var typOtazky = document.querySelector('input[name="volbaOdpovedi' + t + '"]:checked');
        var textOtazky = document.getElementById('otazka'+ t);

        otazky = otazky + '{"typ": "' + typOtazky.value + '", "text": "' + textOtazky.value + '"';

        if (typOtazky.value == "vyber") {
            data = document.querySelectorAll('.podvyber' + t);
            pocetZaskrtnutelnych = document.getElementById("inputvyberucisla" + t).value;
            otazky = otazky + ', "pocetZaskrtnutelnych": ' + pocetZaskrtnutelnych + ', "moznosti": [';

            for (ii = 0; ii < data.length; ii++) {
                vyberZInputu = document.getElementsByName("podvyber" + t)[ii].value;

                otazky = otazky + '{"text": "' + vyberZInputu + '"}, ';
            }
            
            otazky = otazky.slice(0,-2);
            otazky = otazky + ']}, ';
        } else
            otazky = otazky + '}, ';

        t++;
    } while (t < pocetOtazek + 1);

    otazky = otazky.slice(0,-2);
    otazky = otazky + ']}';

    idHodiny = document.getElementById("vyberHodiny").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./ajax.php", false);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("a=otazky&array=" + otazky + "&idHodiny=" + idHodiny);
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.response);
    }

}

function pridatDalsiOtazku() {
    vyberFormularZmena = vyberFormular.replaceAll("#", i.toString());
    if (pocetOtazek > 0){
        pocetOtazekDIV = document.getElementById("otazky").lastChild.insertAdjacentHTML("afterEnd", vyberFormularZmena);
    }else
        document.getElementById("otazky").insertAdjacentHTML("beforeend", vyberFormularZmena);
    pocetOtazek++;
    i++;
}
function moznostOdpovedi(cislo,prostor) {
    var prvky = document.getElementsByName('volbaOdpovedi' + cislo);
    if(!prostor)
        if(document.getElementById("formulareSablonySELECT").value != ""){
            document.getElementById("formulareSablonySELECT").value = "";
            document.getElementById("ulozitFormular").style.visibility = "visible";
        }
        for (j = 0; j < prvky.length; j++) {
            if (prvky[j].checked && prvky[j].value == "vyber") {
                formularVyberZmena = formularVyber.replaceAll("#", cislo.toString());
                document.getElementById("odstranit" + cislo).insertAdjacentHTML("beforebegin", formularVyberZmena);
                return true;
            }
            else if (document.getElementById("pridatVyber" + cislo) != null && prvky[j].value != "vyber") {
                document.getElementById("pridatVyber" + cislo).remove();
                var prvkypodvyberu = document.getElementsByClassName("podvyber" + cislo);
                if (prvkypodvyberu.length > 0)
                    for (jj = prvkypodvyberu.length - 1; jj >= 0; jj--) {
                        document.getElementById(prvkypodvyberu[jj].id).remove();
                    }
            }
    }
}
function odstranitOtazku(cislo) {
    document.getElementById(cislo).remove();
    pocetOtazek--;
}
function pridatDalsiVyber(cislo) {
    if (document.getElementsByName("podvyber" + cislo).length == 0) {
        text = vyberpoctuvybranychpododpovedi.replaceAll("#", cislo.toString());
        document.getElementById("pridatVyber" + cislo).insertAdjacentHTML("beforebegin", text);
        document.getElementById("inputvyberucisla" + cislo).value = 0;
    } else {
        document.getElementById("inputvyberucisla" + cislo).setAttribute("max", document.getElementsByName("podvyber" + cislo).length + 1);
        document.getElementById("inputvyberucisla" + cislo).value = 0;
    }
    var prvkyPodvyberu = document.getElementsByName('podvyber' + pocetpodvyber);
    textareaVyberZmena = textareaVyber.replaceAll("#", cislo.toString());
    textareaVyberZmena = textareaVyberZmena.replaceAll("*", pocetpodvyber.toString());
    pocetpodvyber++;
    document.getElementById("pridatVyber" + cislo).insertAdjacentHTML("beforebegin", textareaVyberZmena);
}
function odstranitPodvyber(cislo) {
    jmenotridy = document.getElementById("podvyber" + cislo).className;
    document.getElementById("podvyber" + cislo).remove();
    pocetpodvyber--;
    if (document.getElementsByClassName(jmenotridy).length == 0) {
        document.getElementById("vyberpoctuvybranychpododpovedi" + jmenotridy.slice(-1)).remove();
    } else {
        document.getElementById("inputvyberucisla" + jmenotridy.slice(-1)).setAttribute("max", document.getElementsByName(jmenotridy).length);
        document.getElementById("inputvyberucisla" + jmenotridy.slice(-1)).value = 0;
    }
}
function zmenacasu() {
    document.getElementById("end").setAttribute("min", document.getElementById("start").value);
    document.getElementById("start").setAttribute("max", document.getElementById("end").value);
    var mySelect = document.getElementById('vyberHodiny');
    for (var ik, j = 0; ik = mySelect.options[j]; j++) {
        if (ik.value == "") {
            mySelect.selectedIndex = j;
            break;
        }
    }
    hodinyPrepis();
}
function hodinyPrepis() {
    startDate = document.getElementById("start").value;
    endDate = document.getElementById("end").value;
    if (endDate !== "" && startDate !== "") { // netřeba řešit zobrazí se všechny/ od / do / mezi
        moznosti = document.getElementById("vyberHodiny").getElementsByTagName("option");
        for(let k = 1; k < moznosti.length; k++){
            datum = moznosti[k].className;
            datumKPorovnani = new Date (datum);
            startovniDatum = new Date (startDate);
            konecneDatum = new Date (endDate);
            if(startovniDatum.getTime() <= datumKPorovnani && konecneDatum.getTime() >= datumKPorovnani){
                moznosti[k].style.visibility = "visible";
                moznosti[k].style.fontSize = "1em";
            }else{
                moznosti[k].style.visibility = "hidden";
                moznosti[k].style.fontSize = "0";
            }
        }    
    }
    else {
        alert("Datum rozsahu musí být zvoleno, zvolte prosím počáteční i koncové datum.")
    }
}
function nastavitDatumyUVyberuDatumu() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = yyyy + "-" + mm + "-" + dd;

    document.getElementById("end").setAttribute("value", today);
    document.getElementById("start").setAttribute("value", today);
}
function pridatNazevFormulare(){
    if(document.getElementById("ulozitFormular").checked){
        var text = "<div id='nazevFormuTextDIV'><textarea name='nazevFormuText' id='nazevFormuText' cols='30' rows='4'></textarea><br></div>";
        document.getElementById("ulozitLabel").insertAdjacentHTML("afterend", text);
    }else{
        document.getElementById("nazevFormuTextDIV").remove();
    }
}
function zmenaformulare() {
    var answer = window.confirm("Pokud vyberete formulář z nabídky, Váš stávající vytvořený formulář se přepíše, opravdu chcete vybrat formulář z nabídky?");
    if (answer) {
        document.getElementById("otazky").innerHTML = "";
        pocetOtazek = 0;
        i = 1;
        pocetpodvyber = 0;
        idFormulare = document.getElementById("formulareSablonySELECT").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./ajax.php", false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("formularID=" + idFormulare);
        if (xhr.readyState == 4 && xhr.status == 200) {
            vratka = JSON.parse(xhr.response);
            console.log(vratka.otazky);
            document.getElementById("vyberCelkovehoHodnoceniHodiny").value = vratka.moznostOdpovedi;
            for(ii = 0;ii<vratka.otazky.length; ii++){
                pridatDalsiOtazku();
                indexOtazkyPredchozi = i-1;
                document.getElementById(vratka.otazky[ii].typ + indexOtazkyPredchozi).checked = true;
                document.getElementById("otazka"+indexOtazkyPredchozi).value = vratka.otazky[ii].text;
                moznost = moznostOdpovedi(indexOtazkyPredchozi, true);
                console.log(moznost);
                if(moznost){
                    for(iii = 0; iii<vratka.otazky[ii].moznosti.length; iii++){
                        pridatDalsiVyber(indexOtazkyPredchozi);
                        pocetpodvyberminusjeden = pocetpodvyber - 1;
                        document.getElementById('podvyber'+pocetpodvyberminusjeden).getElementsByTagName('input')[0].value = vratka.otazky[ii].moznosti[iii].text; 
                    }
                    document.getElementById("inputvyberucisla"+indexOtazkyPredchozi).value = vratka.otazky[ii].pocetZaskrtnutelnych;
                }
            }
        }
        document.getElementById("ulozitFormular").style.visibility = "hidden";
    }else{
        document.getElementById("formulareSablonySELECT").value = "";
        document.getElementById("ulozitFormular").style.visibility = "visible";
    }
}

/*
//odkladiště dějin

    */