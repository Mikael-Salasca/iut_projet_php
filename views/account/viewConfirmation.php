<section id="corps">
    <section id="pannel-information">
        <div id="pannel-info-block-1">
            <p><?php echo translate('INFORMATIONS')?></p>
        </div>
        <div id="pannel-info-content">
            <?php echo translate('Un code de vérification permet d\'être sur que')?> <strong><?php echo translate('vous êtes le propriétaire du compte')?>.</strong>
            <br><br>
            <?php echo translate('Ainsi vos informations sont')?> <strong><?php echo translate('protégées')?>.</strong><br><br>
            <strong><?php echo translate('Le code de vérification expirera au bout de 30 minutes. Si d\'ici là vous n\'avez pas eu le temps d\'accèder à votre boite email')?>,
                <strong> <strong><?php echo translate('pas de panique')?>.</strong> <?php echo translate('Recommencez l\'opération depuis votre gestion de compte')?>.
        </div>
    </section>
    <section id="main-page">
        <div id="block-row">
            <ul class="ak-stepper-list">
                <li><?php echo translate('Email actuel')?></li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="current"><?php echo translate('Code de sécurité')?></li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li><?php echo translate('Nouvelle adresse email')?></li>
            </ul>
        </div>
        <br>
        <br>
        <div class="emailsend">
            <img class="img-111" src="/img/valid-email.png"></img>
        </div>
        <div class="block-12">
            <?php echo translate('Un e-mail vient de vous être envoyé')?>
        </div>
        <div class="id1">
            <p><?php echo translate('Pour continuer, vous devez saisir le code de sécurité qui vient d\'être envoyé sur votre adresse email')?><br> <strong><?php echo $_SESSION['crypt_email']; ?></strong></p>
        </div>
        <br>
        <div class="ak-block-mail">
            <form action="/account/verify_code" method="post">
                <label for="code"> <?php echo translate('Code de sécurité')?> * </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="code" required maxlength="6">
                <?php if(isset($_SESSION['wrong_code'])) echo $_SESSION['wrong_code']; unset($_SESSION['wrong_code']); ?>
                <div class="form-recovery-block-3">
                    <input type="submit" class="button-valid" name="" value="<?php echo translate('VALIDER')?>" />
                </div>
            </form>
        </div>
        <br><br><br>
    </section>
</section>
</section>