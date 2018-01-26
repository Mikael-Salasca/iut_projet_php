<section id="corps">


    <section id="pannel-information">
        <div id="pannel-info-block-1">

            <p><?php echo translate("Droit à l'information") ?></p>
        </div>
        <div id="pannel-info-content">
            <?php echo translate("Les informations de ce formulaire sont"). '<strong> ' . translate("obligatoires") ?></strong>.<br><br><?php echo translate("Elles sont enregistrées dans un fichier informatisé pour vous permettre de") . ' <strong>' . translate("créer votre compte") . '</strong>. <br><br>' . translate("Conformément aux dispositions de la loi \"Informatique et libertés\" du 6 Janvier 1978 vous pouvez exercer votre droit d'accès aux données vous concernant et les faire rectifier en nous contactant") ?>.
        </div>


    </section>


    <section id="main-page">
        <div id="bar-account-3">
            <h1><?php echo translate('Créez votre compte') ?></h1>

        </div>
        <div class="title-bottom-img">
            <img class="title-bottom-img" src="/img/title-bottom1.png">
        </div>
        <br><br>
        <div id="form-inscription">
            <form action = "/inscription/validate" method="post" >
                <label for="identifiant"><?php echo translate("Identifiant") ?></label> </br>
                <input type="text" name="name" maxlength="20" required placeholder=<?php echo translate("Nom de compte") ?> />
                <?php if(isset($_SESSION['error_account_name'])) { echo $_SESSION['error_account_name']; unset($_SESSION['error_account_name']); } ?>
                </br></br>
                <label for="mail"><?php echo translate("Mail") ?></label></br>
                <input type="text" name="mail" required placeholder="E-mail" />
                <?php if(isset($_SESSION['error_account_email'])) { echo $_SESSION['error_account_email']; unset($_SESSION['error_account_email']); } ?>
                </br></br>
                <label for="mdp"><?php echo translate("Mot de passe") ?></label></br>
                <input type="password" name="password" required placeholder=<?php echo translate("Mot de passe") ?>></br></br>
                <label for="mdp2"><?php echo translate("Vérification du mot de passe") ?></label></br>
                <input type="password" name="password2" required placeholder=<?php echo translate("Confirmez le mot de passe") ?>/> </br></br>
                <?php if(isset($_SESSION['error_mdp'])) { echo $_SESSION['error_mdp']; unset($_SESSION['error_mdp']); } ?>

                <input type="checkbox" name="cu" /> <?php echo translate("J'acceptes les") . ' ' ?><a target="_blank" href="/inscription/cu">C.U</a> </br></br>
                <?php if(isset($_SESSION['error_cu'])) { echo $_SESSION['error_cu']; unset($_SESSION['error_cu']); } ?>
                <input type="submit" class="button-inscription" name="" value=<?php echo translate("Terminer l'inscription") ?> />


            </form>
            <?php
            if(isset($_SESSION['error_register']) && !empty($_SESSION['error_register']))
            {
                echo '<br>' . $_SESSION['error_register'];
                unset($_SESSION['error_register']);
            }
            ?>
            <br>
        </div>
    </section>
</section>