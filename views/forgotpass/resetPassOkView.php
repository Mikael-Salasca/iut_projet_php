<section id="corps">
    <section id="pannel-information">
        <div id="pannel-info-block-1">

            <p><?php echo translate('INFORMATIONS');?></p>
        </div>
        <div id="pannel-info-content">
            <?php echo translate('Le mot de passe et l\'adresse email sont les deux informations qui vous permettent de vous connecter à notre site.');?>
            <strong><?php echo translate('Ces informations doivent rester secrètes.');?></strong><br><br>
            <?php echo translate('Il est recommandé d\'avoir un mot de passe pour votre compte sur notre site');?>
            <strong><?php echo translate('différent de celui que vous utilisez pour votre boite email.');?></strong>
            <br><br>
            <?php echo translate('Pour disposer d\'un mot de passe fort,');?> <strong><?php echo translate('utilisez un minimum de 8 caractères et au moins trois des quatre types de caractères suivants');?> </strong><?php echo translate('(majuscule, minuscule, chiffre, caractères spéciaux).');?>
        </div>


    </section>

    <section id="main-page">
        <div id="block-row">
            <ul class="ak-stepper-list">
                <li><?php echo translate('Identification');?></li>&nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li><?php echo translate('Boite email');?></li>&nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="current"><?php echo translate('Modification');?></li>

            </ul>
        </div>

        <br>
        <div id="bar-account">
            <h1><?php echo translate('ENTREZ VOTRE NOUVEAU MOT DE PASSE');?></h1>
            <?php if(isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
        </div>
        <div id="form-recovery-pass">
            <form action="/forgotpass/activerecovery" method = "post">
                <div class="form-recovery-block">
                    <label for="mdp"><?php echo translate('Nouveau mot de passe');?></label></br>
                    <input type="password" name="mdp" required placeholder="<?php echo translate('Nouveau mot de passe');?>"/>
                    <?php if (isset($_SESSION['error_pass'])) echo $_SESSION['error_pass']; ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <label for="mdp"><?php echo translate('Confirmez le nouveau mot de passe');?></label></br>
                    <input type="password" name="mdp2" required placeholder="<?php echo translate('Confirmez le nouveau mot de passe');?>"/>
                    <?php if (isset($_SESSION['error_pass'])) echo $_SESSION['error_pass']; unset($_SESSION['error_pass']); ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <input type="submit" class="button-valid" name="" value="<?php echo translate("VALIDER");?>" />
                    <?php if(isset($_SESSION['error_recovery'])) echo '<br>' .$_SESSION['error_recovery']; unset($_SESSION['error_recovery']); ?>
                </div>

                </br></br>

            </form>

        </div>


    </section>
</section>
</section>
