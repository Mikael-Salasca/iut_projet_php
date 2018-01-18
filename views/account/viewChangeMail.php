<section id="corps">
    <section id="main-page">
        <div id="bar-account-3">
            <h1> Changement d'adresse mail </h1>
        </div>
        <br>

        <p>Pour des raisons de sécurité , veuillez entrer votre adresse email actuelle </p>
        <form action="/account/send_email" method="post">
            Mon adresse mail :
            <input type="text" name="email" required/><br>
            <?php if (isset($_SESSION['error_account_email'])) { echo $_SESSION['error_account_email']; unset($_SESSION['error_account_email']); } ?>
            <input type="submit" value = "Valider"/>
        </form>
    </section>
</section>



