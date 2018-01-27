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
            <li></li>
            <li></li>
        </ul>

    </nav>
</header>

