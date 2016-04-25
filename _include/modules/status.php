<?php

// #AwesomeArray for the server adresses
$adresses = array(
    "website" => "Line-Lan.net",
    "database" => "localhost",
    "mail" => "smtppro.zoho.com",
    "api" => "api.line-lan.net",
    "teamspeak" => "5.230.10.109",
    "dns" => "kevin.ns.cloudflare.com",
    "pingTarget" => "google.de",
);

// Check the Status of a Webserver
function checkStatus($host, $port) {
   if ($socket = @fsockopen($host, $port, $errno, $errstr, 2)) {
      echo 'Online';
      fclose($socket);
   } else {
      echo 'Offline';
   }
}

// Check the latency to a Webserver
function pingStatus($domain) {
   $starttime = microtime(true);
   $file = @fsockopen($domain, 80, $errno, $errstr, 10);
   $stoptime = microtime(true);
   $status = 0;
   if (!$file) {
      $status = -1;
   } else {
      fclose($file);
      $realstatus = ($stoptime - $starttime) * 1000;
      $status = floor($realstatus);
   }
   return $status;
}

switch ($q[1]) {
   case NULL:
      //	/api/status/
      echo('Website: ');
      checkStatus($adresses[website], 80);
      echo('<br />');
      echo('Database: ');
      checkStatus($adresses[database], 3306);
      echo('<br />');
      echo('Mail: ');
      checkStatus($adresses[mail], 110);
      echo('<br />');
      echo('API: ');
      checkStatus($adresses[api], 80);
      echo('<br />');
      echo('Teamspeak: ');
      checkStatus($adresses[teamspeak], 80);
      echo('<br />');
      echo('DNS: ');
      checkStatus($adresses[dns], 53);
      echo('<br />');
      echo('Ping: ');
      echo (pingStatus($adresses[pingTarget]) . ' ms');
      echo('<br />');
      break;
   case website:
      checkStatus($adresses[website], 80);
      break;
   case database:
      checkStatus($adresses[database], 3306);
      break;
   case mail:
      checkStatus($adresses[mail], 110);
      break;
   case api:
      checkStatus($adresses[api], 80);
      break;
   case teamspeak:
      checkStatus($adresses[teamspeak], 80);
      break;
   case dns:
      checkStatus($adresses[dns], 53);
      break;
   case ping:
      echo (pingStatus($adresses[pingTarget]) . ' ms');
      break;
   default:
      //	/api/status/x
      giveError();
      break;
}
