<section id="corps">
    <section id="main-page">
        <div id="bar-account-2">
            <h1> Changement d'adresse mail </h1>
        </div>
        <br>
        <form action="/account/send_email" method="post">
            Nouvelle adresse mail :
            <input type="text" name="new_email" required/><br>
            <?php if (isset($_SESSION['error_account_email'])) { echo $_SESSION['error_account_email']; unset($_SESSION['error_account_email']); } ?>
            <input type="submit" value = "Valider"/>
        </form>
    </section>
</section>



