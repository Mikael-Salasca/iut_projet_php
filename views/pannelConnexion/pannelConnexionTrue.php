<section id="pannel-co">

    <?php

        setlocale(LC_TIME, 'fra_fra');
        echo '<p>'. translate('Bonjour') . '<font color="green"> ' . $_SESSION['name'] . '</font> ! <br><b>'.translate('Vous êtes connecté') .' !</b></p>';
        echo '<br><br>';

        if($_SESSION['isPrenium'])
        {
            echo '<div class="pannel-disconnect"><a href="/premium/my_request">(PREMIUM)' . translate('Consulter le statut de mes demandes') .'</a></div>';
        }
        echo '<br>';
        if($_SESSION['type'] == "ADMIN")
        {
            echo '<div class="pannel-disconnect"><a href="/admin/control">(ADMIN)' . translate('Accéder au panel super utilisateur') .'</a></div>';
        }
        echo '<br>';
        if($_SESSION['isTranslator'])
        {
            echo '<div class="pannel-disconnect"><a href="/translator/control">(TRANSLATOR)' . translate('Accéder à mon interface') .'</a></div>';

        }


        echo '<div class="pannel-co-date"> <p>'. translate('Nous sommes le') . ' ' . strftime('%d %B %Y') . '</p></div>';









    if($_SESSION['isActive'] == 0)
        {
            echo '<br><br><div class="pannel-acc-not-valid">'  .translate('votre compte n\'est pas activé') .'</div>';
        }

    ?>

    <br><br><br>
</section>