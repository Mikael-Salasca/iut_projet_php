<section id="corps">
    <section id="main-page-large">
        <div class="card-header">
            <h2><?php echo translate('Gestion du compte')?></h2>
        </div>
        <div class="row-compte">
            <table id="tab-compte">
                <tr class="c1">
                    <th><?php echo translate('Nom de compte')?></th>
                    <td class="td-1"><?php echo $_SESSION['name']; ?></td>
                    <td class="modif-elem-no"><?php echo translate('Modifier')?></td>
                </tr>
                <tr>
                    <th>&nbsp<?php echo translate('Adresse email')?></th>
                    <td class="td-1"><?php echo $_SESSION['crypt_email']; ?></td>
                    <td class="modif-elem-ok"><a href="/account/modify_email"><?php echo translate('Modifier')?></a></td>
                </tr>
                <tr class="c1">
                    <th><?php echo translate('Mot de passe')?></th>
                    <td class="td-1">**********</td>
                    <td class="modif-elem-ok"><a href="/account/modify_password"><?php echo translate('Modifier')?></a></td>
                </tr>
                <tr>
                    <th><?php echo translate('Date d\'inscription')?></th>
                    <td class="td-1"><?php echo $_SESSION['user']->getDateCreation() ?></td>
                    <td class="modif-elem-no"><?php echo translate('Modifier')?></td>
                </tr>
                <tr class="c1">
                    <th><?php echo translate('Rang')?></th>
                    <td class="td-1"><?php echo $_SESSION['type']; ?></td>
                    <td class="modif-elem-no"><?php echo translate('Modifier')?></td>
                </tr>
                <tr>
                    <th><?php echo translate('Activation')?></th>
                    <?php if ($_SESSION['isActive'] == 1) {
                        echo '<td class="td-1">'. translate('Compte activé') . '</td>';
                    }
                    else{
                        echo '<td class="td-1-no-activ">' . translate('Compte non activé') . '</td>';
                    }
                    ?>
                    </td>
                    <td class="modif-elem-no"><?php echo translate('Modifier')?></td>
                </tr>
            </table>
        </div>
    </section>
</section>