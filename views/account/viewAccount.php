<!--<section id="corps">
    <section id="main-page">
        <div id="bar-account-2">
            <h1> Gestion du compte </h1>
        </div>
        Votre pseudo : <?php //echo $_SESSION['name']; ?>
        <br><br><br>
        Votre adresse mail : <?php //echo $_SESSION['email']; ?>
        <a href = "/account/modify_email">
            Changer
        </a>
        <?php //if (isset($_SESSION['error_register'])) echo $_SESSION['error_register']; unset($_SESSION['error_register']); ?>
        <br><br>
        <a href = "/account/modify_password">
            Changer votre mot de passe
        </a>

    </section>
</section>
-->



<section id="corps">

    <?php // require ROOT . '/views/pannelConnexion/pannelConnexionView.php'; ?>

    <section id="main-page-large">

        <div class="card-header">
            <h2>Gestion du compte</h2>
        </div>


        <div class="row-compte">

            <table id="tab-compte">

                <tr class="c1">
                    <th>&nbsp;Nom de compte</th>
                    <td class="td-1"><?php echo $_SESSION['name']; ?></td>
                    <td class="modif-elem-no">Modifier</td>
                </tr>

                <tr>
                    <th>&nbsp;Adresse email</th>
                    <td class="td-1"><?php echo $_SESSION['crypt_email']; ?></td>
                    <td class="modif-elem-ok"><a href="/account/modify_email">Modifier</a></td>
                </tr>

                <tr class="c1">
                    <th>&nbsp;Mot de passe</th>
                    <td class="td-1">**********</td>
                    <td class="modif-elem-ok"><a href="">Modifier</a></td>
                </tr>

                <tr>
                    <th>&nbsp;Date d'inscription</th>
                    <td class="td-1">01/01/1999</td>
                    <td class="modif-elem-no">Modifier</td>
                </tr>

                <tr class="c1">
                    <th>&nbsp;Rang</th>
                    <td class="td-1"><?php echo $_SESSION['type']; ?></td>
                    <td class="modif-elem-no">Modifier</td>
                </tr>

                <tr>
                    <th>&nbsp;Activation</th>

                        <?php if ($_SESSION['isActive'] == 1) {
                            echo '<td class="td-1">Compte activé</td>';
                            }
                            else{
                            echo '<td class="td-1-no-activ">Compte non activé</td>';
                        }
                        ?>

                    </td>
                    <td class="modif-elem-no">Modifier</td>
                </tr>

            </table>

        </div>
    </section>

</section>