<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyber</title>
</head>
<body>
<div id="kontejner">
    <header>
        <h1>Vyberte svůj obor, třídu a předmět</h1>
    </header>
    <main>
    
<form method="post" action="vyber_zpracovani.php">

<label for="obor">Obor</label><br />
<select class="vyber" name="obor" size="2">
    <option value="EP">Elektonické počítačové systémy</option>
    <option value="IT">Informační technologie</option>
</select>

<label for="rocnik">Ročník</label>
    <select class="vyber" name="rocnik" size="4">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>

<label for="predmet">Předmět</label>
    <select id="vyber" name="tridaIT" size="4">
        <option value="ELE">ELE</option>
        <option value="CMT">CMT</option>
        <option value="PVA">PVA</option>
        <option value="APS">APS</option>
    </select>

    <label for="skupina">Skupina</label>
    <select id="vyber" name="skupina" size="2">
        <option value="1">1.</option>
        <option value="2">2.</option>
    </select>
    <input type="submit" value="Dál">

</form>
</div>
    </main>
    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>