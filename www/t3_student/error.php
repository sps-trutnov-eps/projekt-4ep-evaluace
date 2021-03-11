<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chyba</title>
</head>
<body>


<div id="stranka">
    <header>
        <h1>Je nám líto, ale vyskytla se chyba.</h1>
    </header>
    <main>
    <div id="rozcesti">
        <a href="vyber.php">Zpět</a>
    </div>
<?php

session_start();
$_SESSION = array();
session_destroy();

?>
    </main>
</div>
    <footer>
    <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
    *Image by <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>
</html>