<?php

openSql();
switch ($q[1]) {
   case NULL:
      //	api/games
      $result = $sql->query('Select name from games', MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo $row['name'] . ' <br/>';
      }
      break;
   default:
      //	api/games/x
      if (!is_numeric($q[1])) {
         giveRequestError();
      }
      $q[1] = $sql->real_escape_string($q[1]);
      $result = $sql->query('Select name from games where gameid=' . $q[1], MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo $row['name'];
      }
      break;
}
