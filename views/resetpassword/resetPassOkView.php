<section id="corps">
    <section id="pannel-information">
        <div id="pannel-info-block-1">

            <p>INFORMATIONS</p>
        </div>
        <div id="pannel-info-content">
            Le mot de passe et l'adresse email sont les deux informations qui vous permettent de vous connecter à notre site.
            <strong>Ces informations doivent rester secrètes.</strong><br><br>
            Il est recommandé d'avoir un mot de passe pour votre compte sur notre site
            <strong>différent de celui que vous utilisez pour votre boite email.</strong>
            <br><br>
            Pour disposer d'un mot de passe fort, <strong>utilisez un minimum de 8 caractères et au moins trois des quatre types
                de caractères suivants </strong>(majuscule, minuscule, chiffre, caractère spéciaux).
        </div>


    </section>

    <section id="main-page">


        <br><br><br><br>
        <div id="bar-account">
            <h1>ENTREZ VOTRE NOUVEAU MOT DE PASSE</h1>
            <?php if(isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
        </div><br><br>
        <div id="form-recovery-pass">
            <form action="/connection/activerecovery" method = "post">
                <div class="form-recovery-block">
                    <label for="mdp">Nouveau mot de passe</label></br>
                    <input type="password" name="mdp" required placeholder="Nouveau mot de passe"/>
                    <?php if (isset($_SESSION['error_pass'])) echo $_SESSION['error_pass']; ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <label for="mdp">Confirmez  le nouveau mot de passe</label></br>
                    <input type="password" name="mdp2" required placeholder="Confirmez le nouveau mot de passe"/>
                    <?php if (isset($_SESSION['error_pass'])) echo $_SESSION['error_pass']; unset($_SESSION['error_pass']); ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <input type="submit" class="button-valid" name="" value="VALIDER" />
                </div>
                </br></br>

            </form>

        </div>


    </section>
</section>
</section>