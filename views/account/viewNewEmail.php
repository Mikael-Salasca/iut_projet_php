
    <section id="corps">
        <section id="pannel-information-large">
            <div id="pannel-info-block-1">

                <p><?php echo translate('INFORMATIONS')?></p>
            </div>
            <div id="pannel-info-content">
    <?php echo translate('L\'adresse e-mail est un élément personnel et confidentiel')?>. <strong><?php echo translate('Vous devez donc utiliser votre propre adresse e-mail ')?></strong><?php echo translate('et surtout pas celle d\'un ami ou celle d\'un membre de votre famille')?>.<br><br>

                <?php echo translate('On vous contacte par e-mail pour vous fournir toutes les informations relatives à votre compte : confirmation d\'inscription, nouveau mot de passe, ect')?>.<br><br>

                <strong><?php echo translate('Si quelqu\'un d\'autre que vous a accès à votre adresse e-mail, la sécurité de votre compte est compromise')?>.</strong>
            </div>

        </section>

        <section id="main-page">
            <div id="block-row">
                <ul class="ak-stepper-list">
                    <li><?php echo translate('Email actuel')?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><?php echo translate('Code de sécurité')?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li class="current"><?php echo translate('Nouvelle adresse email')?></li>
                </ul>
            </div>

            <br>
            <div id="bar-account">
                <h1><?php echo translate('Saissisez votre nouvelle adresse email')?></h1> <?php if (isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
            </div>
            <div id="form-recovery-pass">
                <form action="/account/send_new_mail" method="post">

                    <div class="form-recovery-block">
                        <label for="mail"><<?php echo translate('Votre nouvelle adresse email')?></label></br>
                        <input type="text" name="newemail" required placeholder="Votre adresse email"/><?php if (isset($_SESSION['error_account_email'])) {echo $_SESSION['error_account_email'];unset($_SESSION['error_account_email']);} ?>
                    </div>

                    <div class="form-recovery-block-2">
                        <label for="mail"><?php echo translate('Confirmez votre nouvelle adresse email')?></label></br>
                        <input type="text" name="newemail2" required placeholder="Confirmez votre nouvelle adresse"/><?php if (isset($_SESSION['error_account_email'])) {echo $_SESSION['error_account_email'];unset($_SESSION['error_account_email']);} ?>
                    </div>
                    <div class="form-recovery-block-2">
                        <input type="submit" class="button-valid" name="" value="<?php echo translate('VALIDER')?>"/>
                    </div>
                </form>
            </div>


            </br></br>

            </form>

            </div>


        </section>
    </section>

