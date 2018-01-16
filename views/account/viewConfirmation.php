<section id="corps">
    <section id="main-page">
        <div id="bar-account-2">
            <h1>Entrez le code de sécurité qui vous a été envoyé.</h1>
        </div>
        <br>
        <form action="/account/verifycode" method="post">
            Code :
            <input type="password" name="code" required><br>
            <?php if (isset($_SESSION['wrong_code'])) echo $_SESSION['wrong_code']; unset($_SESSION['wrong_code']); ?>
            <input type="submit" value = "Valider">
        </form>
