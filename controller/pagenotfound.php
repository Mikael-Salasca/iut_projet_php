<?php

require ROOT . '/core/controller.php';

Class Pagenotfound extends Controller {

    function displayError()
    {

        require ROOT . '/views/pagenotfoundView.php';

    }

}
