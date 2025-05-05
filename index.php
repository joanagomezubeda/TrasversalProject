<?php

    // Start Session
    session_start();
    require_once('config.php');

    require_once('classes/Messages.php');
    require_once('classes/Bootstrap.php');
    require_once('classes/Controller.php');
    require_once('classes/Model.php');
    require_once('classes/AppService.php');

    require('controllers/home.php');
    require('controllers/users.php');
    require('controllers/borrow.php');
    require('controllers/myLibrary.php');
    require('controllers/community.php');
    require('controllers/lendZone.php');
    require('controllers/dashboard.php');
    require('controllers/politics.php');
    require('controllers/miscellaneus.php');

    require('models/home.php');
    require('models/user.php');
    require('models/borrow.php');
    require('models/myLibrary.php');
    require('models/community.php');
    require('models/lendZone.php');
    require('models/dashboard.php');
    require('models/politics.php');
    require('models/miscellaneus.php');



    $bootstrap = new Bootstrap($_GET);
    $controller = $bootstrap->createController();

    if ($controller){
        $controller->executeAction();
    }
?>