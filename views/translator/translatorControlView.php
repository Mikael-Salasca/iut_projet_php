

<section id="corps">

    <section id="main-page-large">

        <?php if ($_SESSION['type_translation'] == "exist")
            require ROOT . '/views/translator/translatorExistingView.php';
            else
                require ROOT . '/views/translator/translatorRequestView.php';
    ?>
    </section>
</section>
