<section id="corps">
    <section id="pannel-information">
        <div id="pannel-info-block-1">
            <p><?php echo translate('INFORMATIONS')?></p>
        </div>
        <div id="pannel-info-content">
            <?php echo translate('Le mot de passe et l\'adresse email sont les deux informations qui vous permettent de vous connecter à notre site')?>.
            <strong><?php echo translate('Ces informations doivent rester secrètes')?>.</strong><br><br>
            <?php echo translate('Il est recommandé d\'avoir un mot de passe pour votre compte sur notre site')?>
            <strong><?php echo translate('différent de celui que vous utilisez pour votre boite email')?>.</strong>
            <br><br>
            <?php echo translate('Pour disposer d\'un mot de passe fort')?> , <strong><?php echo translate('utilisez un minimum de 8 caractères et au moins trois des quatre types de caractères suivants')?></strong> ( <?php echo translate('majuscule, minuscule, chiffre, caractère spécial')?>.
        </div>
    </section>
    <section id="main-page">
        <br><br><br><br>
        <div id="bar-account">
            <h1><?php echo translate('Modifier mon mot de passe actuel')?></h1>
            <?php if(isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
        </div>
        <div id="form-recovery-pass">
            <form action="/account/send_pass" method = "post">
                <div class="form-recovery-block-2">
                    <label for="mdp"> <?php echo translate('Mot de passe actuel')?> : </label><br>
                    <input type="password" name="mypass" required placeholder="<?php echo translate('Mot de passe actuel')?>"/>
                    <?php if (isset($_SESSION['error_mypass'])) echo $_SESSION['error_mypass']; unset($_SESSION['error_mypass']); ?>
                </div>
                <div class="form-recovery-block-2">
                    <label for="mdp"><?php echo translate('Nouveau mot de passe')?></label></br>
                    <input type="password" name="newpass" required placeholder="<?php echo translate('Nouveau mot de passe')?>"/>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <label for="mdp"><?php echo translate('Confirmez le nouveau mot de passe')?></label></br>
                    <input type="password" name="newpass2" required placeholder="<?php echo translate('Confirmez le nouveau mot de passe')?>"/>
                    <?php if (isset($_SESSION['error_pass'])) echo $_SESSION['error_pass']; unset($_SESSION['error_pass']); ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <input type="submit" class="button-valid" name="" value="<?php echo translate('VALIDER')?>" />
                </div>
                </br></br>
            </form>
        </div>
    </section>
</section>