<section id="corps">


    <section id="pannel-information">
        <div id="pannel-info-block-1">

            <p>Droit à l'information</p>
        </div>
        <div id="pannel-info-content">
            Les informations de ce formulaire sont <strong>obligatoires</strong>.<br><br>Elles sont enregistrées dans un fichier informatisé pour vous permettre de <strong>créer votre compte</strong>. <br><br>Conformément aux dispositions de la loi "Informatique et libertés" du 6 Janvier 1978 vous pouvez exercer votre droit d'accès aux données vous concernant et les faire rectifier en nous contactant.
        </div>


    </section>


    <section id="main-page">
        <div id="bar-account-3">
            <h1>Créez votre compte</h1>

        </div>
        <div class="title-bottom-img">
            <img class="title-bottom-img" src="/img/title-bottom1.png">
        </div>
        <br><br>
        <div id="form-inscription">
            <form action = "/inscription/validate" method="post" >
                <label for="identifiant">Identifiant</label> </br>
                <input type="text" name="name" maxlength="20" required placeholder="Nom de compte" />
                <?php if(isset($_SESSION['error_account_name'])) { echo $_SESSION['error_account_name']; unset($_SESSION['error_account_name']); } ?>
                </br></br>
                <label for="mail">Mail</label></br>
                <input type="text" name="mail" required placeholder="E-mail" />
                <?php if(isset($_SESSION['error_account_email'])) { echo $_SESSION['error_account_email']; unset($_SESSION['error_account_email']); } ?>
                </br></br>
                <label for="mdp">Mot de passe</label></br>
                <input type="password" name="password" required placeholder="Mot de passe"/></br></br>
                <label for="mdp2">Vérification du mot de passe</label></br>
                <input type="password" name="password2" required placeholder="Confirmez le mot de passe"/> </br></br>
                <?php if(isset($_SESSION['error_mdp'])) { echo $_SESSION['error_mdp']; unset($_SESSION['error_mdp']); } ?>

                <input type="checkbox" name="cu" /> J'acceptes les <a target="_blank" href="/inscription/cu">C.U</a> </br></br>
                <?php if(isset($_SESSION['error_cu'])) { echo $_SESSION['error_cu']; unset($_SESSION['error_cu']); } ?>
                <input type="submit" class="button-inscription" name="" value="Terminer l'inscription" />


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