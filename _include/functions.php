<?php

function requireHTTPS() {
   //Always use a secure connection with HTTPS

   /* //Fallback to use with CloudFlare Flexible SSL
     if($_SERVER['HTTP_X_FORWARDED_PROTO'] != "https") {
     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
     exit();
     }
    */
   if ($_SERVER['HTTPS'] != "on") {
      header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
      exit();
   }
}

function openSql() {
   require_once 'config.php';
   global $sql;
   $sql = new mysqli($db_server, $db_user, $db_password, $db_database);
}

function cleanup() {
   if ($result != NULL) {
      $result->free();
      $sql->close();
   }
}

function rdirDoc() {
   header('HTTP/1.1 301 Moved Permanently');
   header("Location: https://api.line-lan.net/docs");
   header("Connection: close");
   die();
}

function giveError() {
   header("HTTP/1.1 404 Not Found");
   die("ERROR 404: The requested API-Endpoint \"api/" . $_GET["query"] . "\" was not found!");
}
