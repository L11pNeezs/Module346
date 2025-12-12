<?php

//Code to test both environments below

//

session_start();
require __DIR__.'/../vendor/autoload.php';

\App\Libraries\Core\Application::boot()->handleRequest();
