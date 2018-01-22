

<section id="corps">

    <section id="main-page-large">
        EN DEVELOPPEMENT
        SI vous etes la c que vous etes un traducteur

        <form method="post" action="/translator/update_translation">
        <table style="color: black; border: solid;width: 100%">
            <tr>
                <td>Francais</td>
                <td>Anglais</td>

            </tr>

            <?php foreach ($allTuple as $objWord) {

                echo '<tr>';
                echo '<td><textarea style="width: 100%" name ="textareaSource['. $objWord->getId() . '][' . $objWord->getLangSource() . ']">'. $objWord->getDataSource() . '</textarea>';
                echo '<td><textarea style="width: 100%" name ="textareaTarget['. $objWord->getId() . '][' . $objWord->getLangDestination() . ']">'. $objWord->getDataDestination() .'</textarea>';
                echo '<td><input type="checkbox" name="checkbox[' .$objWord->getId() . ']" value="' . $objWord->getId() . '">';
                echo '</tr>';

            }



                /*
                echo '<tr>';
                foreach ($objWord as $key => $value) {
                    if ($key == 'ID_TRANSLATION') {
                        $current_id = $value;
                    } else {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';

                }
            }

                */
                        ?>



        </table>

            <input type="submit" value="envoyer">
        </form>
        <?php if(isset($_SESSION['update_translation_msg'])) echo $_SESSION['update_translation_msg']; unset($_SESSION['update_translation_msg']); ?>

    </section>
</section>
