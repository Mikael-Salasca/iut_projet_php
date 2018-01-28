<section id="corps">


        <section id="main-page">
            <div id="block-row">
                <ul class="ak-stepper-list">
                    <li class="current"><?php echo translate('Email actuel')?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><?php echo translate('Code de sécurité')?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><?php echo translate('Nouvelle adresse email')?></li>
                </ul>
            </div>

            <br>
            <div id="bar-account">
                <h1><?php echo translate('Saississez votre adresse email actuelle')?></h1>
                <?php if (isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
            </div>
            <div id="form-recovery-pass">
                <form action="/account/send_email" method="post">
                    <div class="form-recovery-block">
                        <label for="compte"><?php echo translate('Votre adresse email')?></label></br>
                        <input type="text" name="email" required placeholder="<?php echo translate('Votre adresse email')?>"/>
                        <?php if (isset($_SESSION['error_account_email'])) {
                            echo $_SESSION['error_account_email'];
                            unset($_SESSION['error_account_email']);
                        } ?>
                    </div>
                    </br>
                    <div class="form-recovery-block-2">
                        <input type="submit" class="button-valid" name="" value="<?php echo translate('VALIDER')?>"/>
                    </div>
                    </br></br>

                </form>

            </div>


        </section>
    </section>
</section>

