var dny = ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"];
var data = ["--","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
var mesice = ["01","02","03","04","05","06","07","08","09","10","11","12"];

function pridatHodinu(id) {
    document.getElementById("popup").style.display = "flex";            //  POPUP OKENKO
    if (document.getElementById(id).innerHTML == "") {
        document.getElementById("potvrdit").setAttribute("onclick", "odesilaniDoDB('" + id + "')");
    } else {
        document.getElementById("potvrdit").setAttribute("onclick", "meneniVDB('" + id + "')");
    }
}

function odesilaniDoDB(id) {
    document.getElementById("popup").style.display = "none";
    var predmet = document.getElementById("predmet").value;
    var trida = document.getElementById("trida").value;
    var skupina = document.getElementById("skupina").value;
    var skolniHodina = id;
    var datum = document.getElementById(id).getAttribute("value");
    var newDate = new Date (datum);
    var yyyy = newDate.getFullYear() + 1;
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
        var noveDatum = newDate;
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

            for (let i = 14; noveDatum<konecSkolnihoRoku && noveDatum<dvaTydnyPred; i=i+14) {
                noveDatum = newDate.addDays(i);
                var rok = noveDatum.getFullYear();
                var mesic = mesice[noveDatum.getMonth()];
                var den = data[noveDatum.getDate()];
                var novyDatum = rok+"-"+mesic+"-"+den;
                
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

    var aktualniDatum = new Date();

    if (aktualniDatum > konecSkolnihoRoku) {
        // O PRÁZDNINÁCH SMAZÁNÍ Z DATABÁZE
    }
}

function meneniVDB(id) {
    document.getElementById("popup").style.display = "none";
    var predmet = document.getElementById("predmet").value;
    var trida = document.getElementById("trida").value;
    var skupina = document.getElementById("skupina").value;
    var skolniHodina = id;
    var datum = document.getElementById(id).getAttribute("value");
    var newDate = new Date (datum);
    var yyyy = newDate.getFullYear() + 1;
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
        var noveDatum = newDate;
        for (let o = 0; o < 1; o++) {
            $.ajax(
            {
                type: "POST",
                url: "ucitel_meneniDB.php",
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

            for (let i = 14; noveDatum<konecSkolnihoRoku && noveDatum<dvaTydnyPred; i=i+14) {
                noveDatum = newDate.addDays(i);
                var rok = noveDatum.getFullYear();
                var mesic = mesice[noveDatum.getMonth()];
                var den = data[noveDatum.getDate()];
                var novyDatum = rok+"-"+mesic+"-"+den;
                
                $.ajax(
                    {
                        type: "POST",
                        url: "ucitel_meneniDB.php",
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

    var aktualniDatum = new Date();

    /*if (aktualniDatum > konecSkolnihoRoku) {
        // O PRÁZDNINÁCH SMAZÁNÍ Z DATABÁZE
    }*/
}

function vlozeniHodinDoRozvrhu(skolniHodina) {
    $.ajax(
        {
            type: "POST",
            url: "ucitel_vypsaniHodin.php",
            data: {
                skolniHodina: skolniHodina
            },
            success: function(data) {
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
                    $("#" + skolniHodina).attr("onclick", "vypsaniTemat(this.id)");
                }
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
        );
}

function vypsaniTemat(id) {
    $.ajax(
        {
            type: "POST",
            url: "ucitel_vypsaniTemat.php",
            data: {
                skolniHodina: id
            },
            success: function(data) {
                sessionStorage.setItem("id", id);
                document.getElementById("datum").style.display = "flex";
                nastavitDatumyUVyberuDatumu();
                let regex = /,]/gi;
                let odpoved = data.replace(regex, "]");
                let json = JSON.parse(odpoved);
                if (json == undefined) {
                }
                else {
                    var pole = "";
                    for (i = 0; i < json.predmet.length; i++) {
                        var u = new Date(json.datum[i]);
                        var dd = String(u.getDate()).padStart(2, '0');
                        var mm = String(u.getMonth() + 1).padStart(2, '0');
                        var yyyy = u.getFullYear();
                        var datumVALUE = yyyy + "-" + mm + "-" + dd;
                        var idTema = '"' + datumVALUE + '"';
                        var datum = u.getDate() + "." + (u.getMonth() + 1) + "." + u.getFullYear();
                        if (json.temaHodiny[i] == "") {
                            if (json.skupina[i] == 1 || json.skupina[i] == 2) {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - <input type='button' onclick='popupTema(" + idTema+ ")' value='Přidat téma hodiny'> - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina -  - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                            }
                            else {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - <input type='button' onclick='popupTema(" + idTema+ ")' value='Přidat téma hodiny'> - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída -  - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                            }
                        } else {
                            if (json.skupina[i] == 1 || json.skupina[i] == 2) {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - " + json.temaHodiny[i] + " - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - " + json.temaHodiny[i] + " - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                            }
                            else {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - " + json.temaHodiny[i] + " - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - " + json.temaHodiny[i] + " - <a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                            }
                        }
                        
                    }
                    
                    document.getElementById("temata").innerHTML = pole;
                }
                $("#datum").attr("value", json.predmet[0]);
                $("#datum").attr("name", json.trida[0]);
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
        );
}

function hodinyPrepis() {
    var hodina = document.getElementById("datum").getAttribute("value");
    var trida = document.getElementById("datum").getAttribute("name");
    var Od = document.getElementById("end").getAttribute("min");
    var Do = document.getElementById("start").getAttribute("max");

    $.ajax(
        {
            type: "POST",
            url: "ucitel_filtrTemat.php",
            data: {
                predmet: hodina,
                trida: trida,
                Od: Od,
                Do: Do
            },
            success: function(data) {
                document.getElementById("datum").style.display = "flex";
                nastavitDatumyUVyberuDatumu();
                let regex = /,]/gi;
                let odpoved = data.replace(regex, "]");
                let json = JSON.parse(odpoved);
                if (json == undefined) {
                }
                else {
                    var pole = "";
                    for (i = 0; i < json.predmet.length; i++) {
                        var u = new Date(json.datum[i]);
                        var dd = String(u.getDate()).padStart(2, '0');
                        var mm = String(u.getMonth() + 1).padStart(2, '0');
                        var yyyy = u.getFullYear();
                        var datumVALUE = yyyy + "-" + mm + "-" + dd;
                        var idTema = '"' + datumVALUE + '"';
                        var datum = u.getDate() + "." + (u.getMonth() + 1) + "." + u.getFullYear();
                        if (json.temaHodiny[i] == "") {
                            if (json.skupina[i] == 1 || json.skupina[i] == 2) {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - <input type='button' onclick='popupTema(" + idTema+ ")' value='Přidat téma hodiny'><a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina</div>";
                                }
                            }
                            else {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - <input type='button' onclick='popupTema(" + idTema+ ")' value='Přidat téma hodiny'><a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída</div>";
                                }
                            }
                        } else {
                            if (json.skupina[i] == 1 || json.skupina[i] == 2) {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - " + json.temaHodiny[i] + "<a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + json.skupina[i] + ". skupina - " + json.temaHodiny[i] + "</div>";
                                }
                            }
                            else {
                                if (json.zruseno[i] == 0) {
                                    pole += "<div id='radek'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' unchecked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - " + json.temaHodiny[i] + "<a href='dotaznik.php?id=" + json.idHodiny[i] + "'><input type='button' value='Tvorba dotazníku'></a></div>";
                                }
                                else {
                                    pole += "<div id='radek' style='text-decoration: line-through;'><input type='checkbox' id='" + datumVALUE + "' onclick='zruseno(this.id)' checked>" + datum + " - " + json.predmet[i] + " - " + json.trida[i] + " - " + "Celá třída - " + json.temaHodiny[i] + "</div>";
                                }
                            }
                        }
                        
                    }
                    
                    document.getElementById("temata").innerHTML = pole;
                }
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
        );
}

function zruseno (id) {
    var datum = id;
    var predmet = $("#datum").attr("value");
    var trida = $("#datum").attr("name");

    $.ajax(
        {
            type: "POST",
            url: "ucitel_zruseno.php",
            data: {
                predmet: predmet,
                trida: trida,
                datum: datum
            },
            success: function() {
                vypsaniTemat(sessionStorage.getItem("id"));
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
    );
}

function zmenacasu() {
    document.getElementById("end").setAttribute("min", document.getElementById("start").value);
    document.getElementById("start").setAttribute("max", document.getElementById("end").value);
    hodinyPrepis();
}

function reset() {
    var id = sessionStorage.getItem("id");
    vypsaniTemat(id);
}

function popupTema(id) {
    var predmet = $("#datum").attr("value");
    var trida = $("#datum").attr("name");
    var datum = id;
    document.getElementById("popupTema").innerHTML = "<input type='text' id='temaHodiny' placeholder='Zadejte téma hodiny...'><input type='button' id='poslatTema' value='Potvrdit'>"
    document.getElementById("popupTema").style.display = "flex";
    poslatTemaDoDB(predmet, trida, datum);
}

function poslatTemaDoDB (predmet, trida, datum) {
    $("#poslatTema").click(function() {
        var tema = document.getElementById("temaHodiny").value;
        document.getElementById("popupTema").style.display = "none";
        document.getElementById("popupTema").innerHTML = "";
        $.ajax(
            {
                type: "POST",
                url: "ucitel_poslatTemaDoDB.php",
                data: {
                    predmet: predmet,
                    trida: trida,
                    datum: datum,
                    tema: tema
                },
                success: function() {
                    vypsaniTemat(sessionStorage.getItem("id"));
                },
                error: function() {
                    alert("Při zpracování dotazu došlo k neočekávané chybě.");
                }
            }
        );
    })
    
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
            $("#popup").removeAttr("style").hide();
            generovatRozvrh();
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

function nastavitDatumyUVyberuDatumu() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = yyyy + "-" + mm + "-" + dd;

    document.getElementById("end").setAttribute("value", today);
    document.getElementById("start").setAttribute("value", today);
}

/*function testPrihlaseni() {
    $.ajax(
        {
            type: "LOAD",
            url: "ucitel_kontrolaPrihlaseni.php",
            success: function(data) {
                if (data == 0) {
                    alert("Nejste přihlášen/a.");
                    location.href = "ucitel_prihlaseni.html";
                }
            },
            error: function() {
                alert("Při zpracování dotazu došlo k neočekávané chybě.");
            }
        }
    );
}*/

$(document).ready(function () {
    sudyLichy();
    generovatRozvrh();
    upravaRozvrhu();
    dataProPopupOkenko();
    //testPrihlaseni();
});