<?php
//Includes some useful functions
require_once '_include/functions.php';
//Always use HTTPS, comment to allow HTTP traffic
requireHTTPS();

$q = explode("/", $_GET["query"], 10);

if (file_exists('_include/modules/'.$q[0].'.php')) {
   require_once '_include/modules/'.$q[0].'.php';
} elseif ($q[0] == NULL) {
   rdirDoc();
} else {
   giveError();
}
cleanup();
