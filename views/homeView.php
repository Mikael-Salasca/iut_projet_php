
<section id="corps">

        <?php // require ROOT . '/views/pannelConnexion/pannelConnexionView.php'; ?>

    <section id="main-page-center">
        <br><br><br>
        <div id="block-11">
            <img class="drap-1" src="/img/drapeau-france.jpg">
            <img class="drap-2" src="/img/drapeau-anglais.png">
        </div>
        <br>
        <h1><?php echo translate("Bienvenue sur notre site de traduction 100 % gratuit") ?> !</h1>
        <br><br><br>
        Langues disponibles : <br>
        <table id="panel-langs">
            <?php $langs = $_SESSION['langs'];?>

            <?php foreach ($langs as $lang => $percentage) {
                //if ($key == 0) continue;
                $percentage = (int)$percentage;
                echo'<tr>';
                echo '<td>' . $lang. '</td>';
                echo '<td>' . $percentage . '% ';
                if ($percentage != 100) echo translate('Aidez nous à traduire le site en cette langue en achetant le compte premium à 699€ !');
                echo '</td>';
                echo'</tr>';
            }?>

        </table>
        <!--<p>Créer vous un compte pour pouvoir dépasser de suite la restriction des 10 minutes de recherche ! C'est gratuit et ça mange pas de pain !</p>
        <br>
        <p>Si vous souhaitez soutenir notre site , vous pouvez souscrire à un abonnement prenium qui vous offre des petits avantages tel que la recherche par pertinence !</p>
        <br>
        <p> Si vous avez des suggestions ou rencontrez un problème sur le site, n'hessitez pas à nous contacter via le menu Contact !</p>
        -->
        <p>(<?php echo translate("Page de présentation temporaire") ?>)</p>
    </section>

</section>

