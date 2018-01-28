<section id="corps">
    <?php require ROOT . '/views/pannelConnexion/pannelConnexionView.php'; ?>
    <?php if(isset($_SESSION['user']))
        echo '<section id="main-page">';
    else
        echo '<section id="main-page-center">';
    ?>
    <br><br><br>
    <div id="block-11">
        <img class="drap-1" src="/img/drapeau-france.jpg">
        <img class="drap-2" src="/img/drapeau-anglais.png">
    </div>
    <br>
    <h1><?php echo translate("Bienvenue sur notre site de traduction 100 % gratuit") . '(' . translate('enfin presque') .')' ?> !</h1>
    <br><br><br>
    <p><?php echo translate('Créer vous un compte pour pouvoir dépasser de suite la restriction des 10 minutes de recherche')?> !<?php echo translate('C\'est gratuit et ça mange pas de pain')?> !</p>
    <br>
    <p><?php echo translate('Langues disponibles'); ?></p>
    <br>
    <table id="panel-langs" class="tab-home">
        <?php $langs = $_SESSION['langs'];?>
        <?php foreach ($langs as $lang => $percentage) {
            //if ($key == 0) continue;
            $percentage = (int)$percentage;
            echo'<tr>';
            echo '<td>' . $lang. '</td>';
            echo '<td><div id="bar-befpro2"><div id="bar-progres" style="width: '.$percentage .'%"> ' . $percentage . '%</div></div> ';

            echo '</td>';
            echo'</tr>';
        }?>
    </table>
    <?php if ($percentage != 100) echo translate('Aidez nous à traduire le site en cette langue en achetant le compte premium à 699€ !'); ?>
    <p>(<?php echo translate("Page de présentation temporaire") ?>)</p>
</section>
</section>