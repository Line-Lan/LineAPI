<?php

// Array for the server adresses
$adresses = array(
    "website" => "Line-Lan.net",
    "database" => "localhost",
    "mail" => "mail.line-lan.net",
    "api" => "api.line-lan.net",
    "teamspeak" => "5.230.10.109",
    "dns" => "kevin.ns.cloudflare.com",
    "pingTarget" => "google.de",
);

// Array with ports of different protocols
$ports = array(
   "http" => 80,
   "https" => 443,
   "mysql" => 3306,
   "teamspeak" => 10011,
   "imap" => 993,
   "dns" => 53,
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
      checkStatus($adresses[website], $ports["https"]);
      echo('<br />');
      echo('Database: ');
      checkStatus($adresses[database], $ports["mysql"]);
      echo('<br />');
      echo('Mail: ');
      checkStatus($adresses[mail], $ports["imap"]);
      echo('<br />');
      echo('API: ');
      checkStatus($adresses[api], $ports["https"]);
      echo('<br />');
      echo('Teamspeak: ');
      checkStatus($adresses[teamspeak], $ports["teamspeak"]);
      echo('<br />');
      echo('DNS: ');
      checkStatus($adresses[dns], $ports["dns"]);
      echo('<br />');
      echo('Ping: ');
      echo (pingStatus($adresses[pingTarget]) . ' ms');
      echo('<br />');
      break;
   case website:
      checkStatus($adresses[website], $ports["https"]);
      break;
   case database:
      checkStatus($adresses[database], $ports["mysql"]);
      break;
   case mail:
      checkStatus($adresses[mail], $ports["imap"]);
      break;
   case api:
      checkStatus($adresses[api], $ports["https"]);
      break;
   case teamspeak:
      checkStatus($adresses[teamspeak], $ports["teamspeak"]);
      break;
   case dns:
      checkStatus($adresses[dns], $ports["dns"]);
      break;
   case ping:
      echo (pingStatus($adresses[pingTarget]) . ' ms');
      break;
   default:
      //	/api/status/x
      giveError();
      break;
}
