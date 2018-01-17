<section id="pannel-co">

    <?php
    if(isset($_SESSION['login']) && $_SESSION['login'] == 'ok')
    {
        setlocale(LC_TIME, 'fra_fra');
        echo '<p>Bonjour<font color="green"> ' . $_SESSION['name'] . '</font> ! <br><b>Vous êtes connecté !</b></p>';
        echo '<br><br>';
        echo '<p><u>Type de compte</u> : ' . $_SESSION['account_type'] . '</p>';
        echo '<br><br>';
        echo '<div class="pannel-co-date"> <p>Nous sommes le ' .strftime('%d %B %Y') . '</p></div>';


    }






    if(isset($_SESSION['account_active']) && $_SESSION['account_active'] == 0)
        {
            echo '<br><br><div class="pannel-acc-not-valid">Attention, votre compte n\'est pas activé.</div>';
        }

    ?>

    <br><br><br>
    <div class="pannel-disconnect"><a href="/home/disconnect">Se déconnecter</a></div>
</section>