<header>
    <? php
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'ok')
        require 'idBarNotConnect.php';
    else
        require 'idBarConnect.php';
    ?>

    <nav class="navbar-menu">

        <ul class="navbar-nav">
            <li><a href="/">Accueil</a></li>
            <li><a href="">Traducteur</a></li>
            <li></li>

            <li><a href="">Menu 3</a></li>
            <li><a href="">Menu 4</a></li>
        </ul>

    </nav>
</header>