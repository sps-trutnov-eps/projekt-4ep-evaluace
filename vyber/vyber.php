<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyber</title>
</head>
<body>
    <header>
        <h1>Vyberte svůj obor, třídu a předmět</h1>
    </header>
    <main>
        <nav>
            <form method="post" action="vyber_zpracovani.php">
                <label for="obor">Obor</label><br />
                    <select id="obor" name="obor" size="2">
                        <option value="1">Elektonické počítačové systémy</option>
                        <option value="2">Informační technologie</option>
                    </select><br />

                <label for="rocnik">Ročník</label><br />
                    <select id="rocnik" name="rocnik" size="4">
                        <option value="1">1.</option>
                        <option value="2">2.</option>
                        <option value="3">3.</option>
                        <option value="4">4.</option>
                    </select><br />

                <label for="predmet">Předmět</label><br />
                    <select id="predmet" name="predmet" size="5">
                        <option value="1">APS</option>
                        <option value="2">ICT</option>
                        <option value="3">PVA</option>
                        <option value="4">POS</option>
                        <option value="5">OPS</option>
                    </select><br />

                <input type="submit" value="Pokračovat" />
            </form>
        </nav>
    </main>
    <footer>
    </footer>
</body>
</html>