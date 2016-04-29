<?php
//Includes some useful functions
require_once '_include/functions.php';
//Always use HTTPS, comment to allow HTTP traffic
requireHTTPS();

$q = explode("/", $_GET["query"], 10);
switch ($q[0]) {
   case NULL:
      rdirDoc();
   case "games":
      include '_include/modules/games.php';
      break;
   case "users":
      include '_include/modules/users.php';
      break;
   case "news":
      include '_include/modules/news.php';
      break;
   case "server":
      include '_include/modules/server.php';
      break;
   case "tournaments":
      include '_include/modules/tournaments.php';
      break;
   case "status":
      include '_include/modules/status.php';
      break;
   default:
      giveError();
}
cleanup();
