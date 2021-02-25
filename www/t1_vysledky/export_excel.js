function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('Detail');//id tabulky

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replaceAll(/<A[^>]*>|<\/A>/g, "");//odstranit pokud chceme nechat odkazy
    tab_text= tab_text.replaceAll(/<img[^>]*>/gi,""); //odstranit pokud chceme obrázky
    tab_text= tab_text.replaceAll(/<input[^>]*>|<\/input>/gi, ""); //odstraní input pparametry
    tab_text= tab_text.replaceAll("č", "c"); //odstraní č
    tab_text= tab_text.replaceAll("ř", "r"); //odstraní ř
    tab_text= tab_text.replaceAll("ě", "e"); //odstraní ě
    tab_text= tab_text.replaceAll("š", "s"); //odstraní š
    tab_text= tab_text.replaceAll("ť", "t"); //odstraní ť
    tab_text= tab_text.replaceAll("ž", "z"); //odstraní ž
    tab_text= tab_text.replaceAll("ů", "u"); //odstraní ů
    tab_text= tab_text.replaceAll("ň", "n"); //odstraní ň

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))//Pro Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Export.xls");
    }  
    else//ostatní prohlížeče s chromiem
    {
        sa = window.open('data:application/vnd.ms-excel,' + escape(tab_text));
    }
    
    return (sa);
}

function chechbox_all(vse) {
    var checkboxy = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxy.length; i++) {
        if (checkboxy[i] != vse)
            checkboxy[i].checked = vse.checked;
    }
}