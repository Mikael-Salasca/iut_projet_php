<section id="corps">

    <section id="pannel-co">
        <br><br><br><br><br><br>
        <p>Vous n'êtes pas connecté !</p>
    </section>
    <section id="main-page">
        <div id="bar-account">
            <h1>Créer votre compte</h1>
        </div>
        <br><br>
        <div id="form-inscription">
            <form action = "../inscription/validate" method="post" >
                <label for="identifiant">Identifiant</label> </br>
                <input type="text" name="name" maxlength="20" required />  </br></br>
                <label for="mail">Mail</label></br>
                <input type="text" name="mail" required />  </br></br>
                <label for="mdp">Mot de passe</label></br>
                <input type="password" name="password" required /></br></br>
                <label for="mdp2">Vérification du mot de passe</label></br>
                <input type="password" name="password2" required/> </br></br>

                <input type="checkbox" name="cu" /> J'acceptes les C.U </br></br>
                <input type="submit" name="" value="Terminer l'inscription	" />


            </form>
            <br>
        </div>
    </section>
</section>