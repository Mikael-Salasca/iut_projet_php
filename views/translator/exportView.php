<section id="corps">
    <section id="main-page">
        <p><?php echo translate('Langues à exporter')?> :</p>
        <form method="post" action="/translator/sub_export">
            <?php echo translate('Source')?>
            <select class="select-admin" name="lgSource">
                <?php foreach ($all_langues as $lang) {
                    $option = '<option value="' . $lang . '" ';
                    $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                    echo $option;

                } ?>
            </select>
            <?php echo translate('Destination')?>
            <select class="select-admin" name="lgTarget">
                <?php
                foreach ($all_langues as $lang) {
                    $option = '<option value="' . $lang . '" ';
                    $option .= '">' . translate($lang, 'ENGLISH') . '</option>';
                    echo $option;

                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="<?php echo translate('Exporter')?>">
        </form>
    </section>
</section>