<?php
    include 'utils.inc.php';
    start_page('Inscription');
?>

    <form action="../connection/validate" method = "post">
        Identifiant : <input type="text" name="name" />  </br>
        Mot de passe : <input type="password" name="mdp"/> </br>
        <input type="submit" name="" value="Se connecter" />
    </form>

<?php
    end_page();
?>

