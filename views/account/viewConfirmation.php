<section id="corps">
    <section id="main-page">
        <div id="bar-account-3">
            <h1>Changé d'adresse email</h1>
        </div>
        <br>
        <p>Veuillez entré votre nouvelle adresse email ainsi que le code envoyé à votre adresse mail actuel</p>
        <form action="/account/verifycode" method="post">

             Nouvel email :
            <input type="text" name="new_email" required><br>
            <?php if (isset($_SESSION['error_account_email'])) echo $_SESSION['error_account_email']; unset($_SESSION['error_account_email']); ?>
             Confirmez le nouvel email :
            <input type="text" name="new_email2" required><br>

            Code :
            <input type="text" name="code" required><br>
            <?php if (isset($_SESSION['wrong_code'])) echo $_SESSION['wrong_code']; unset($_SESSION['wrong_code']); ?>
            <input type="submit" value = "Valider">
        </form>
    </section>
</section>