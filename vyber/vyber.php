<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyber</title>
</head>
<body>
    <header>
        <h1>Výběr hodiny</h1>
    </header>
    <main>
        <nav>
            <form method="post" action="ZATIM_NEEXISTUJE">

                <label for="trida">Třída</label><br />
                <select id="trida" name="trida" size="5">
                    <option value="1">1.EP</option>
                    <option value="2">2.EP</option>
                    <option value="3">3.EP</option>
                    <option value="4">4.EP</option>
                    <option value="5">1.IT</option>
                    <option value="6">2.IT</option>
                    <option value="7">3.IT</option>
                    <option value="8">4.IT</option>
                </select><br />

                <label for="predmet">Předmět</label><br />
                <select id="predmet" name="predmet" size="5">
                    <option value="1">APS</option>
                    <option value="2">ICT</option>
                    <option value="3">PVA</option>
                    <option value="4">POS</option>
                    <option value="5">OPS</option>
                </select><br />

                <input type="submit" value="Potvrdit" />
            </form>
        </nav>
    </main>
    <footer>
    </footer>
</body>
</html>