<section id="corps">

    <section id="pannel-information">
        <div id="pannel-info-block-1">

            <p><?php echo translate("Pourquoi dois-je activer mon compte") ?> ?</p>
        </div>
        <div id="pannel-info-content">
                <?php echo translate("Il est important pour nous de s'assurer de la") ?> <strong><?php echo translate("sécurité") ?></strong> <?php echo translate("de votre compte") . '!' . translate("Ainsi vos informations sont sûrs d'être protégés") ?>.
            <br><br>
            <?php echo translate("Attention, vous ne pourrez pas") ?> <strong><?php echo translate("profiter des avantages") ?></strong> <?php echo  translate("d'un compte normal tant que vous ne l'aurez pas activé") ?>.
            <br><br>

        </div>


    </section>




    <section id="main-page">
        <div id="bar-account-3">
            <h1><?php echo translate("Créez votre compte") ?></h1>

        </div>
        <div class="title-bottom-img">
            <img class="title-bottom-img" src="/img/title-bottom1.png">
        </div>
        <br><br>
        <div class="emailsend">
            <img src="/img/mail.webp"></img>
        </div>

        <div class="ak-mailsend">
            <?php echo translate("C'est presque terminé") ?> !
        </div>

        <div id="bar-befpro">
            <div id="bar-progres">
                90%
            </div>
        </div>
        <br>
        <div id="ak-mail-text">
            <?php echo translate("Vous avez reçu un email à l'adresse") ?> :<br> <strong><?php echo $_SESSION['email_send'] ?></strong>
        </div>
        <br><br>
    </section>
</section>