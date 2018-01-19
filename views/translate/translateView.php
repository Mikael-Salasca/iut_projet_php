


<section id="translate-page">

    <div>
        <h1>Traduction</h1>
    </div>

    <div id="form-translation">
        <form action = "/translation/displayTranslation" method="post" >

            <select name="langSrc">
                <option value="FRENCH"> Français </option>
                <option value="ENGLISH"> Anglais </option>
                <option value="AUTO"> Détecter la langue </option>
            </select>

            <textarea name="word-to-translate"> </textarea> </br> </br></br>

            <select name="langDest">
                <option value="FRENCH"> Français </option>
                <option value="ENGLISH"> Anglais </option>
                <option value="AUTO"> Détecter la langue </option>
            </select>

            <div> Mot traduit :  <?php echo $translation?> </div>



            <input type="submit" name="action" value="Traduire" />



        </form>
    </div>
</section>