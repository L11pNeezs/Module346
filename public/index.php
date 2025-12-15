<?php

session_start();
require __DIR__.'/../vendor/autoload.php';

//Code to test both environments below

//

\App\Libraries\Core\Application::boot()->handleRequest();
