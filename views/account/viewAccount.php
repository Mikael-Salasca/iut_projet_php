<section id="corps">
    <section id="main-page">
        <div id="bar-account-2">
            <h1> Gestion du compte </h1>
        </div>
        Votre pseudo : <?php echo $_SESSION['name']; ?>
        <br><br><br>
        Votre adresse mail : <?php echo $_SESSION['email']; ?>
        <a href = "/account/modify_email">
            Changer
        </a>
        <?php if (isset($_SESSION['error_register'])) echo $_SESSION['error_register']; unset($_SESSION['error_register']); ?>
        <br><br>
        <a href = "/account/modify_password">
            Changer votre mot de passe
        </a>

    </section>
</section>