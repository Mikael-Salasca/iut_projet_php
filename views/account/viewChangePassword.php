<section id="corps">
    <section id="main-page">
        <div id="bar-account-3">
            <h1> Modifier mon mot de pass </h1>
        </div>
        <br>


        <form action="/account/send_pass" method="post">
            Votre mot de passe actuel :
            <input type="password" name="mypass" required/><br>
            <?php if (isset($_SESSION['error_mypass'])) { echo $_SESSION['error_mypass']; unset($_SESSION['error_mypass']); } ?>
            Votre nouveau mot de passe :
            <input type="password" name="newpass" required/><br>
            <?php if (isset($_SESSION['error_pass'])) { echo $_SESSION['error_pass']; unset($_SESSION['error_pass']); } ?>
            Confirmez votre nouveau mot de passe :
            <input type="password" name="newpass2" required/><br>
            <?php if (isset($_SESSION['error_pass'])) { echo $_SESSION['error_pass']; unset($_SESSION['error_pass']); } ?>
            <input type="submit" value = "Valider"/>
        </form>
    </section>
</section>



