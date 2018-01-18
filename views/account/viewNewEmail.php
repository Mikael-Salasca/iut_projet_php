
    <section id="corps">
        <section id="pannel-information-large">
            <div id="pannel-info-block-1">

                <p>INFORMATIONS</p>
            </div>
            <div id="pannel-info-content">
                L'adresse e-mail est un élément personnel et confidentiel. <strong>Vous devez donc utiliser votre propre adresse e-mail</strong> et surtout pas celle d'un ami ou celle d'un membre de votre famille.<br><br>

                On vous contacte par e-mail pour vous fournir toutes les informations relatives à votre compte : confirmation d'inscription, nouveau mot de passe, ect.<br><br>

                <strong>Si quelqu'un d'autre que vous a accès à votre adresse e-mail, la sécurité de votre compte est compromise.</strong>
            </div>

        </section>

        <section id="main-page">
            <div id="block-row">
                <ul class="ak-stepper-list">
                    <li>Email actuelle</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li>Code de sécurité</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li class="current">Nouvelle adresse email</li>
                </ul>
            </div>

            <br>
            <div id="bar-account">
                <h1>Saissisez votre nouvelle adresse email</h1> <?php if (isset($_SESSION['error_system'])) echo $_SESSION['error_system']; unset($_SESSION['error_system']); ?>
            </div>
            <div id="form-recovery-pass">
                <form action="/account/send_new_mail" method="post">

                    <div class="form-recovery-block">
                        <label for="mail">Votre nouvelle adresse email</label></br>
                        <input type="text" name="newemail" required placeholder="Votre adresse email"/><?php if (isset($_SESSION['error_account_email'])) {echo $_SESSION['error_account_email'];unset($_SESSION['error_account_email']);} ?>
                    </div>

                    <div class="form-recovery-block-2">
                        <label for="mail">Confirmez votre nouvelle adresse email</label></br>
                        <input type="text" name="newemail2" required placeholder="Confirmez votre nouvelle adresse"/><?php if (isset($_SESSION['error_account_email'])) {echo $_SESSION['error_account_email'];unset($_SESSION['error_account_email']);} ?>
                    </div>
                    <div class="form-recovery-block-2">
                        <input type="submit" class="button-valid" name="" value="VALIDER"/>
                    </div>
                </form>
            </div>


            </br></br>

            </form>

            </div>


        </section>
    </section>

