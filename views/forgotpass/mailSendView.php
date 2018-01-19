<section id="corps">


    <section id="pannel-information-large">
        <div id="pannel-info-block-1">

            <p>INFORMATIONS</p>
        </div>
        <div id="pannel-info-content">
            <strong>Un e-mail vient d'être envoyé sur l'adresse e-mail associée à ce compte.</strong>
            <br><br>
            Si vous ne recevez rien sur la boite e-mail que vous pensez être la bonne, vérifiez dans chacune de vos boîtes e-mail. Vous avez peut-être inscrit votre compte avec une adresse e-mail que vous n'utilisez pas souvent et vous n'avez pas pensé à la consulter.
            <br><br>
            Vérifiez également dans le dossier Courrier indésirable ou Spam. Certains fournisseurs de messagerie mettent en place des filtres automatiques.
            <br><br>
            En cas de soucis , contactez nous.
        </div>


    </section>

    <section id="main-page">

        <div id="block-row">
            <ul class="ak-stepper-list">
                <li>Identification</li>&nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="current">Boite email</li>&nbsp;&nbsp;&nbsp;&nbsp;----------------------&nbsp;&nbsp;&nbsp;&nbsp;
                <li>Modification</li>

            </ul>
        </div>

        <br><br>
        <div class="emailsend">
            <img src="/img/valid-email.png"></img>
        </div>
        <br>
        <div class="id1">Nous venons de vous envoyer un e-mail qui vous permettra de choisir un nouveau mot de passe dans un délai de 48 heures.</div>
        <div class="block-12">
            L'email a été envoyé à : <br>
            <?php echo $_SESSION['email_send']; ?>
        </div>


    </section>
</section>