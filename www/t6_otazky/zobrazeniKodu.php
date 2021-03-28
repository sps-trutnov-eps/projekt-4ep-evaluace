<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>T6_Zadání formuláře</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
    <header>
        <h1>Zobrazení kódu pro formulář</h1>
        <div id="stranka">
            <?php
                session_start();
                echo "<b>Kód:</b><br />" . $_SESSION['kod'] . "<br />";
                echo "<b>Možno vyplnit do:</b><br />" . date("d.m.Y H:i", strtotime($_SESSION['cas'])) . "<br />";
            ?>
            <button onclick="locationRozvrh()">Zpět</button>
        </div>
    </header>
    <script src="script_dotaznik.js"></script>
    <footer>
        <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
        *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>
</html>