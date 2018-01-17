<div class="ak-idbar">
    <ul id="menu">
        <li>
            <a href="#"><?php if (isset($_SESSION['name'])) echo strtoupper($_SESSION['name']) . '&nbsp;' ; ?>
                <img class="img-responsive" src="/img/profil.png"></a>
            <ul class="hidden">
                <li class="bl-1"><a href="#">Mon compte</a></li>
                <li><a href="/home/disconnect">Deconnexion</a></li>

            </ul>
        </li>
    </ul>
</div>

