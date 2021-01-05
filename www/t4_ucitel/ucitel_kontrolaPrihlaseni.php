<?php

session_start();
if ($_SESSION['idUcitel'] == NULL) {
    $_SESSION['idUcitel'] = 0;
    echo 0;
} else {
    echo 1;
}
