<section id="pannel-co">
    <p>Vous êtes connecté !</p>

    <?php

    if(isset($_SESSION['account_active']) && $_SESSION['account_active'] == 0)
        {
            echo '<br><br><div class="pannel-acc-not-valid">Attention, votre compte n\'est pas activé.</div>';
        }

    ?>
    <br><br><br>
    <div class="pannel-disconnect"><a href="/connection/disconnect">Se déconnecter</a></div>
</section>