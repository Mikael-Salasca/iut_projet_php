<section id="corps">

    <section id="main-page-center">
        <div id="bar-account">
            <h1>Connexion</h1>
        </div>
        <br><br>
        <div id="form-inscription-co">
            <form action="../connection/validate" method = "post">
                <label for="email">Adresse email</label></br>
                <input type="text" name="email" required/>  </br></br>
                <label for="mdp">Mot de passe</label></br>
                <input type="password" name="mdp" required/> </br></br>
                <input type="submit" class="button-connexion" name="" value="Se connecter" /></br></br>
                <a href="/connection/impossible">Impossible de se connecter ?</a>
            </form>
            <?php
                if(isset($_SESSION['error_connexion']) || !empty($_SESSION['error_connexion']))
                {
                    echo '<br>' . $_SESSION['error_connexion'];
                    unset($_SESSION['error_connexion']);
                }
            ?>
        </div>
    </section>
</section>



