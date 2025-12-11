<?php

//Code to test both environments below

//

session_start();
require __DIR__.'/../vendor/autoload.php';

// Verbose Log (only shows in dev)
log_verbose('Incoming request to ' . ($_SERVER['REQUEST_URI'] ?? '/'));

// Debug log (only shows in dev)
log_debug("Boostrapping application...");

\App\Libraries\Core\Application::boot()->handleRequest();
