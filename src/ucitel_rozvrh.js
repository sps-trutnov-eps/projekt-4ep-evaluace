var dny = ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"];
var data = ["--","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
var mesice = ["01","02","03","04","05","06","07","08","09","10","11","12"];

function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    document.getElementById("potvrdit").setAttribute("onclick", "odesilaniDoDB('" + id + "')");

}

function odesilaniDoDB(id) {
    document.getElementById("popup").style.display = "none";
    var predmet = document.getElementById("predmet").value;
    var trida = document.getElementById("trida").value;
    var skupina = document.getElementById("skupina").value;
    var skolniHodina = id;
    var datum = document.getElementById(id).getAttribute("value");  
    //2020-09-01
    var newDate = new Date (datum);
    var yyyy = newDate.getFullYear() + 1;
    var mm = newDate.getMonth();
    var dd = newDate.getDate();
    var konecSkolnihoRoku = new Date(yyyy, 6, 1);
    var dvaTydnyPred = new Date(yyyy, 5, 17);

    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    if (predmet == "")
        alert("Nevyplnil/a jste všechny údaje.");
    else if (trida == "")
        alert("Nevyplnil/a jste všechny údaje.");
    else if (skupina == "")
        alert("Nevyplnil/a jste všechny údaje.");
    else {
        var zkouska = newDate;
        for (let o = 0; o < 1; o++) {
            $.ajax(
            {
                type: "POST",
                url: "ucitel_odeslaniDB.php",
                data: {
                    predmet: predmet,
                    trida: trida,
                    skupina: skupina,
                    skolniHodina: skolniHodina,
                    datum: datum
                },
                success: function() {
                },
                error: function() {
                    alert("Při zpracování dotazu došlo k neočekávané chybě.");
                }
            }
            );
            console.log(datum);
            for (let i = 14; zkouska<konecSkolnihoRoku && zkouska<dvaTydnyPred; i=i+14) {
                zkouska = newDate.addDays(i);
                var rok = zkouska.getFullYear();
                var mesic = mesice[zkouska.getMonth()];
                var den = data[zkouska.getDate()];
                var novyDatum = rok+"-"+mesic+"-"+den;
                console.log(novyDatum);
                $.ajax(
                    {
                        type: "POST",
                        url: "ucitel_odeslaniDB.php",
                        data: {
                            predmet: predmet,
                            trida: trida,
                            skupina: skupina,
                            skolniHodina: skolniHodina,
                            datum: novyDatum
                        },
                        success: function() {
                        },
                        error: function() {
                            alert("Při zpracování dotazu došlo k neočekávané chybě.");
                        }
                    }
                );
            }
        }
    }
    vlozeniHodinDoRozvrhu(skolniHodina);
}

function generovatRozvrh() {
        var tyden = document.getElementById("sudyLichy").innerHTML;
        var pole = "";
        for (i = 1; i <= 5; i++) {
            pole += "<tr><th>" + dny[i] + "</th>";
            for (y = 1; y <= 9; y++) {
                pole += "<td id='"+ tyden + "_" + y + "_" + dny[i] + "' onclick=''></td>";          //  GENERACE ROZVRHU
                vlozeniHodinDoRozvrhu(tyden + "_" + y + "_" + dny[i]);
            }
            pole += "</tr>";
        }
        document.getElementById("rozvrh").innerHTML = pole;
        pridaniDatumu();
}

function pridaniDatumu() {
    var prvnihoZari = new Date();
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

function vlozeniHodinDoRozvrhu(skolniHodina) {
    console.log(skolniHodina);
    $.ajax(
        {
            type: "POST",
            url: "ucitel_vypsaniHodin.php",
            data: {
                skolniHodina: skolniHodina
            },
            success: function(data) {
                console.log(data);
                let odpoved = JSON.parse(data)["data"];
                if (odpoved[0] == undefined) {
                }
                else {
                    if (odpoved[2] == 0)
                        var pole = "<div>" + odpoved[0] + "</div><div>" + odpoved[1] + "</div><div>celá třída</div>";
                    else if (odpoved[2] == 1)
                        var pole = "<div>" + odpoved[0] + "</div><div>" + odpoved[1] + "</div><div>1. skupina</div>";
                    else
                        var pole = "<div>" + odpoved[0] + "</div><div>" + odpoved[1] + "</div><div>2. skupina</div>";
                    
                    document.getElementById(skolniHodina).innerHTML = pole;
                }
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
        );
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
                $("td").attr("onclick", "pridatHodinu(this.id)");
            }
            else if (document.getElementById("sudyLichy").innerHTML == sudy && document.getElementById("sudyLichy").value == 2) {
                document.getElementById("sudyLichy").innerHTML = lichy;
                document.getElementById("sudyLichy").value = "1";
                generovatRozvrh();
                $("td").attr("onclick", "pridatHodinu(this.id)");
            }
            else if (document.getElementById("sudyLichy").innerHTML == sudy && document.getElementById("sudyLichy").value == 1) {
                document.getElementById("sudyLichy").innerHTML = lichy;
                document.getElementById("sudyLichy").value = "2";
                generovatRozvrh();
                $("td").attr("onclick", "pridatHodinu(this.id)");
            }
            else {
                document.getElementById("sudyLichy").innerHTML = sudy;
                document.getElementById("sudyLichy").value = "1";
                generovatRozvrh();
                $("td").attr("onclick", "pridatHodinu(this.id)");
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

function dataProPopupOkenko() {
    $.ajax(
        {
            type: "LOAD",
            url: "ucitel_popup.php",
            success: function(data) {
                let odpoved1 = JSON.parse(data)["data1"];
                let odpoved2 = JSON.parse(data)["data2"];
                
                let predmety = "<option value='' selected disabled hidden>Vyberte předmět</option>";
                for(let i in odpoved1)
                    predmety += "<option value=" + odpoved1[i]["id"] + ">" + odpoved1[i]["nazev"] + "</option>";

                let tridy = "<option value='' selected disabled hidden>Vyberte třídu</option>";
                for(let i in odpoved2)
                    tridy += "<option value=" + odpoved2[i]["id"] + ">" + odpoved2[i]["nazev"] + "</option>";
    
                $("#predmet").html(predmety);
                $("#trida").html(tridy);
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
    );
}

$(document).ready(function () {
    sudyLichy();
    generovatRozvrh();
    upravaRozvrhu();
    dataProPopupOkenko();
});