<?php

session_start();
$_SESSION['idUcitel'] = NULL;
header("location:ucitel_prihlaseni.html");