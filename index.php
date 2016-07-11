<?php
// Includes some useful functions
require_once '_include/functions.php';

// Always use HTTPS, comment out to allow HTTP traffic
requireHTTPS();

// Splitting the request into parts of $q (query array)
$q = explode("/", $_GET["query"], 10);

if (file_exists('_include/modules/'.$q[0].'.php')) {
   require_once '_include/modules/'.$q[0].'.php';
} elseif ($q[0] == NULL) { // no module given
   rdirDoc();
} else { // module not found
   giveError();
}
cleanup();
