var dny = ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"];
var data = ["--","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
var mesice = ["01","02","03","04","05","06","07","08","09","10","11","12"];

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
                pole += "<td id='"+ tyden + "_" + y + "_" + dny[i] + "' onclick=''></td>";          //          GENERACE ROZVRHU
            }
            pole += "</tr>";
        }
        document.getElementById("rozvrh").innerHTML = pole;
        pridaniDatumu();
}

function pridaniDatumu() {
    var prvnihoZari = new Date(2021, 9, 0);
    prvnihoZari.setMonth(8, 1);
    var den = prvnihoZari.getDate();
    var mesic = prvnihoZari.getMonth();
    var rok = prvnihoZari.getFullYear();
    var aktualniTyden = document.getElementById("sudyLichy");
    var denPrvniho = prvnihoZari.getDay();
    var doplneni = prvnihoZari.getDay() - 1;
    var denPristihoT = prvnihoZari.getDate() + 13;

    for (denPrvniho; denPrvniho <= 5; denPrvniho++) {
        if (prvnihoZari.getDay() == 6) {

        }
        else if (prvnihoZari.getDay() == 0) {

        }
        else {
            if (aktualniTyden.innerHTML == "Lichý" && aktualniTyden.value == 1) {
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[denPrvniho]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[den]);
                }
            }
            else if (aktualniTyden.innerHTML == "Lichý" && aktualniTyden.value == 2) {
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[denPrvniho]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[(den + 7)]);
                }
            }
            
            else if (aktualniTyden.innerHTML == "Sudý" && aktualniTyden.value == 1) {
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[denPrvniho]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[den]);
                }
            }
            else if (aktualniTyden.innerHTML == "Sudý" && aktualniTyden.value == 2) {
                for (let x = 1; x <= 9; x++) {
                    document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[denPrvniho]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[(den + 7)]);
                }
            }
        }
        den++;
    }
    prvnihoZari.setMonth(8, 1);
    den = prvnihoZari.getDate();

    for (y = 1; y <= doplneni; doplneni--) {
        if (aktualniTyden.innerHTML == "Lichý" && aktualniTyden.value == 1) {
            for (let x = 1; x <= 9; x++) {
                document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[doplneni]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[denPristihoT]);
            }
        }
        else if (aktualniTyden.innerHTML == "Lichý" && aktualniTyden.value == 2) {
            for (let x = 1; x <= 9; x++) {
                document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[doplneni]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[(den+6)]);
            }
        }
        
        else if (aktualniTyden.innerHTML == "Sudý" && aktualniTyden.value == 1) {
            for (let x = 1; x <= 9; x++) {
                document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[doplneni]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[denPristihoT]);
            }           
        }
        else if (aktualniTyden.innerHTML == "Sudý" && aktualniTyden.value == 2) {
            for (let x = 1; x <= 9; x++) {
                document.getElementById(aktualniTyden.innerHTML+"_"+x+"_"+dny[doplneni]).setAttribute("value", rok + "-" + mesice[mesic] + "-" + data[(den+6)]);
            }
        }
        denPristihoT--;
        den--;
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
        document.getElementById("sudyLichy").value = "1";
    }
    else {
        document.getElementById("sudyLichy").innerHTML = sudy;                                      //          SUDÝ/LICHÝ TÝDEN
        document.getElementById("sudyLichy").value = "1";
    }

    $("#sudyLichy").click(function () {
            if (document.getElementById("sudyLichy").innerHTML == lichy && document.getElementById("sudyLichy").value == 1) {
                document.getElementById("sudyLichy").innerHTML = sudy;
                document.getElementById("sudyLichy").value = "2";
                generovatRozvrh();
            }
            else if (document.getElementById("sudyLichy").innerHTML == sudy && document.getElementById("sudyLichy").value == 2) {
                document.getElementById("sudyLichy").innerHTML = lichy;
                document.getElementById("sudyLichy").value = "1";
                generovatRozvrh();
            }
            else if (document.getElementById("sudyLichy").innerHTML == sudy && document.getElementById("sudyLichy").value == 1) {
                document.getElementById("sudyLichy").innerHTML = lichy;
                document.getElementById("sudyLichy").value = "2";
                generovatRozvrh();
            }
            else {
                document.getElementById("sudyLichy").innerHTML = sudy;
                document.getElementById("sudyLichy").value = "1";
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
})