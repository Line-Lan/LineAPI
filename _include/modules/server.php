<?php

openSql();
// /api/server/
switch ($q[1]) {
   case NULL:
      $result = $sql->query('Select ipaddress, games.name from servers, games where tourneyid = 0 and games.gameid = servers.gameid', MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ($row['ipaddress'] . ' ');
         echo ($row['name'] . '<br/>');
      }
      break;
   case raw:
      $result = $sql->query('Select ipaddress, games.name from servers, games where tourneyid = 0 and games.gameid = servers.gameid', MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ($row['ipaddress'] . ',');
         echo ($row['name'] . ',');
      }
      break;
   default:
      $result = $sql->query('Select ipaddress, games.name from servers, games where tourneyid = 0 and games.gameid = servers.gameid and servers.id=' . $q[1], MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ($row['ipaddress'] . ',');
         echo ($row['name']);
      }
}
