<?php //page d'inscription
    include 'utils.inc.php';
    start_page('Inscription');
?>

    <form action = "../inscription/validate" method="post" >
        Identifiant <input type="text" name="name" />  </br>
        Mail : <input type="text" name="mail" />  </br>
        Mot de passe : <input type="password" name="password" /></br>
        Vérification du mot de passe : <input type="password" /> </br>

        <input type="checkbox" name="cu" /> J'acceptes les C.U </br>
        <input type="submit" name="" value="enregistrer" />

    </form>
<?php
    end_page();
?>

