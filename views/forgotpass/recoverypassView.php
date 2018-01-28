<section id="corps">
    <section id="pannel-information">
        <div id="pannel-info-block-1">
            <p><?php echo translate('INFORMATIONS');?></p>
        </div>
        <div id="pannel-info-content">
            <strong><?php echo translate('Pour récupérer un nouveau mot de passe, nous devons vérifier que vous êtes bien le propriétaire du compte et de l\'adresse e-mail associée.');?></strong>
            <br><br>
            <?php echo translate('Une fois identifié, nous vous enverrons un e-mail pour modifier le mot de passe du compte concerné.');?>
            <br><br>
            <strong><?php echo translate('L\'adresse e-mail est un élément personnel et confidentiel');?></strong>
            <?php echo translate('Vous devez utiliser votre propre adresse e-mail et surtout pas celle d\'un ami ni même celle d\'un membre de votre famille.');?>
        </div>
    </section>
    <section id="main-page">
        <div id="block-row">
            <ul class="ak-stepper-list">
                <li class="current"><?php echo translate('Identification');?></li>
                &nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li><?php echo translate('Boite email');?></li>
                &nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li><?php echo translate('Modification');?></li>
            </ul>
        </div>
        <br>
        <div id="bar-account">
            <h1><?php echo translate('Identifiez le compte concerné');?></h1>
            <?php if(isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
        </div>
        <div id="form-recovery-pass">
            <form action="/forgotpass/recoverypass" method = "post">
                <div class="form-recovery-block">
                    <label for="compte"><?php echo translate('Votre nom de compte');?></label></br>
                    <input type="text" name="account" required placeholder="Votre nom de compte"/>
                    <?php if (isset($_SESSION['error_account'])) echo $_SESSION['error_account']; ?>
                </div>
                </br>
                <div class="form-recovery-block-2">
                    <label for="mdp"><?php echo translate('Votre adresse email');?></label></br>
                    <input type="text" name="mail" required placeholder="Votre adresse email"/>
                    <?php if (isset($_SESSION['error_account'])) echo $_SESSION['error_account']; unset($_SESSION['error_account']); ?>
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