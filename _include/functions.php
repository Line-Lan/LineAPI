<?php

function requireHTTPS() {
   // Always use a secure connection with HTTPS

   // Below version of the method is a fallback for when the secure connection is interrupted,
   // for example when using CloudFlare Flexible SSL this might be the case.
  /*  
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
   // creating the object $sql for interacting with the database
   require_once 'config.php';
   global $sql;
   $sql = new mysqli($db_server, $db_user, $db_password, $db_database);
}

function cleanup() {
   // closing database connection if still connected
   if ($result != NULL) {
      $result->free();
      $sql->close();
   }
}

function rdirDoc() {
   // 301 redirect to the documentation
   header('HTTP/1.1 301 Moved Permanently');
   header("Location: https://api.line-lan.net/docs");
   header("Connection: close");
   die();
}

function giveError() {
   // 404 error for nonexistent API calls
   header("HTTP/1.1 404 Not Found");
   die("HTTP/1.1 404: The requested API-Endpoint \"api/" . $_GET["query"] . "\" was not found!");
}

function giveRequestError() {
   // 400 error if the request contains errors
   header("HTTP/1.1 400 Bad Request");
   die("HTTP/1.1 400: The request to \"api/" . $_GET["query"] . "\" could not be completed!");
   
}