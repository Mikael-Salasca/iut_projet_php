<?php
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'ok')
    {
        require 'pannelConnexionFalse.php';
    }
    else
    {
        require 'pannelConnexionTrue.php';
    }

