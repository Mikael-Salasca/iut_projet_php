<header>
    <?php
    if(!isset($_SESSION['user']) )
        require 'idBarNotConnect.php';
    else
        require 'idBarConnect.php';
    ?>

    <nav class="navbar-menu">

        <ul class="navbar-nav">
            <li><a href="/"><?php echo translate("Accueil") ?></a></li>
            <li><a href="/translation/translate"><?php echo translate("Traduction") ?></a></li>
            <li></li>

            <li><a href="">Menu 3</a></li>
            <li><a href="">Menu 4</a></li>
        </ul>

    </nav>
</header>