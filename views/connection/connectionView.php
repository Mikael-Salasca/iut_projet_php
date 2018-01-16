<section id="corps">


    <section id="pannel-register">
        <br><br><br><br><br><br><br>
        <strong>Pas de compte ?</strong>
        <br><br>
        <div class="button-valid-3">
            <a href="/inscription/register">Créer un compte</a>
        </div>

    </section>

    <section id="main-page">
        <div id="bar-account-2">
            <h1>Connexion</h1>
        </div>
        <br><br>
        <div id="form-connect">
            <form action="../connection/validate" method = "post">
                <div class="form-recovery-block">
                    <label for="email">Adresse email</label></br>
                    <input type="text" name="email" required/>  </br></br>
                    <?php if(isset($_SESSION['error_connexion'])) echo $_SESSION['error_connexion']; unset($_SESSION['error_connexion']); ?>
                </div>

                <div class="form-recovery-block">
                    <label for="mdp">Mot de passe</label></br>
                    <input type="password" name="mdp" required/> </br></br>
                </div>
                <div class="form-recovery-block-2">
                    <input type="submit" class="button-valid-2" name="" value="Se connecter" /></br></br>
                    <a href="/connection/impossible">Impossible de se connecter ?</a>
                </div>

            </form>

        </div>
    </section>
</section>