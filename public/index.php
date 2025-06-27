<?php

session_start();
require __DIR__.'/../vendor/autoload.php';

\App\Libraries\Core\Application::boot()->handleRequest();
