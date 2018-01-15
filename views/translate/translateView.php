


<section id="translate-page">

    <div>
        <h1>Traduction</h1>
    </div>

    <div id="form-translation">
        <form action = "/translation/displayTranslation" method="post" >
            <textarea name="word-to-translate"> </textarea> </br>


            <select name="langSrc">
                <option value="FRENCH"> Français </option>
                <option value="ENGLISH"> Anglais </option>
                <option value="AUTO"> Détecter la langue </option>
            </select>

            <select name="langDest">
                <option value="FRENCH"> Français </option>
                <option value="ENGLISH"> Anglais </option>
                <option value="AUTO"> Détecter la langue </option>
            </select>

            <h1> Mot traduit :  <?php echo $translation?> </h1></br>



            <input type="submit" name="action" value="Traduire" />



        </form>
    </div>
</section>