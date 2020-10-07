<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyber</title>
</head>
<body>
    <header>
        <h1>Vyberte svoj obor, třídu a předmět</h1>
    </header>
    <main>
        <nav>
            <form method="post" action="vyber_zpracovani.php">

                <label for="obor">Obor</label><br />
                <select id="obor" name="obor" size="5">
                    <option value="1">Elektonické počítačové systémy</option>
                    <option value="1a">1.EP</option>
                    <option value="2b">2.EP</option>
                    <option value="3c">3.EP</option>
                    <option value="4d">4.EP</option>

                    <option value="2">Informační technologie</option>
                    <option value="5a">1.IT</option>
                    <option value="6b">2.IT</option>
                    <option value="7c">3.IT</option>
                    <option value="8d">4.IT</option>
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