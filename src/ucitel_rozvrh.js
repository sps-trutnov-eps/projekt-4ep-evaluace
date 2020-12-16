var dny = ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"];

function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    $("#potvrdit").click(function() {
        document.getElementById("popup").style.display = "none";
        var predmet = document.getElementById("predmet").value;         //  POTŘEBA UDĚLAT PHP NA ODESLÁNÍ S IDčkem POLE
        document.getElementById(id).innerHTML = predmet;
    })
}

function generovatRozvrh() {
        var tyden = document.getElementById("sudyLichy").innerHTML;
        var pole = "";
        for (i = 1; i <= 5; i++) {
            pole += "<tr><th>" + dny[i] + "</th>";
            for (y = 1; y <= 9; y++) {
                pole += "<td id='" + dny[i] + "' value='"+ tyden + "_" + y + "_" + dny[i] + "' onclick=''></td>";          //          GENERACE ROZVRHU
            }
            pole += "</tr>";
        }
        document.getElementById("rozvrh").innerHTML = pole;
}

function pridaniDatumu() {
    var d = new Date(2020,10,30);
    var den = d.getDate();
    var mesic = d.getMonth();
    var rok = d.getFullYear();
    var posledniDenMesice = new Date(rok, mesic + 1, 0); //.getDate
    var posledniDenMinulyhoMesice = new Date(rok, mesic, 0);
    var posledniDenRoku = new Date(rok, 12, 0)
    var novyRok = new Date (rok + 1, 0);
    var denVtydnuPlus = d.getDay();
    var denVtydnuMinus = (d.getDay()-1);
    var denPlus = den;
    var denMinus = (den - 1);
    
    for (denVtydnuPlus; denVtydnuPlus <= 5; denVtydnuPlus++) {
        if (denPlus > posledniDenMesice.getDate() && posledniDenMesice.getMonth() === mesic) {
            if (denPlus > posledniDenRoku.getDate() && posledniDenRoku.getMonth() === mesic) {
                denPlus = 1;
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(dny[denVtydnuPlus]).setAttribute("id", novyRok.getFullYear() + "-" + (novyRok.getMonth() + 1) + "-" + denPlus);
                }
            }
            else {
                denPlus = 1;
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(dny[denVtydnuPlus]).setAttribute("id", rok + "-" + (mesic + 1) + "-" + denPlus);
                    
                }
            }
        }
        else {
            for (let x = 1; x <= 9; x++) {
                document.getElementById(dny[denVtydnuPlus]).setAttribute("id", rok + "-" + (mesic + 1) + "-" + denPlus);
            }
        }
        denPlus++;
    }

    for (denVtydnuMinus; denVtydnuMinus > 0; denVtydnuMinus--) {
        for (let z = 1; z <= 9; z++) {
            if (denMinus < 1) {
                if (denMinus < 1 && novyRok.getMonth() === mesic) {
                    document.getElementById(dny[denVtydnuMinus]).setAttribute("id", staryRok.getFullYear() + "-" + (staryRok.getMonth()) + "-" + denMinus);
                }
                else {
                    document.getElementById(dny[denVtydnuMinus]).setAttribute("id", rok + "-" + mesic + "-" + denMinus);
                }
                denMinus = posledniDenMinulyhoMesice.getDate();
            }
            else {
                document.getElementById(dny[denVtydnuMinus]).setAttribute("id", rok + "-" + (mesic + 1) + "-" + denMinus);
            }
        }
        denMinus--;
    }
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
    pridaniDatumu();
})