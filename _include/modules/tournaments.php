<?php

openSql();
// api/tournaments/
switch ($q[1]) {
   case NULL:
      $result = $sql->query('Select name From tournaments', MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ($row['name'] . '<br/>');
      }
      break;
   default:
      switch ($q[2]) {
         case NULL:
            $result = $sql->query('Select name From tournaments Where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['name']);
            }
            break;
         case "type":
            $result = $sql->query('Select ttype From tournaments Where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               switch ($row['ttype']) {
                  case 1:
                     echo ("boiloff");
                     break;
                  case 2:
                     echo ("single elimination");
                     break;
                  case 3:
                     echo ("consolation");
                     break;
                  case 4:
                     echo ("double elimination");
                     break;
                  case 5:
                     echo ("round robin");
                     break;
               }
            }
            break;
         case "game":
            $result = $sql->query('select games.name from games, tournaments where games.gameid = tournaments.gameid and tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['name']);
            }
            break;
         case "teamcount":
            $result = $sql->query('select max_teams from tournaments where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['max_teams']);
            }
            break;
         case "teamsize":
            $result = $sql->query('select per_team from tournaments where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['per_team']);
            }
            break;
         case "notes":
            $result = $sql->query('select notes from tournaments where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['notes']);
            }
            break;
         case "settings":
            $result = $sql->query('select settings from tournaments where tourneyid=' . $q[1], MYSQLI_USE_RESULT);
            while ($row = $result->fetch_assoc()) {
               echo ($row['settings']);
            }
            break;
         default:
            giveError();
      }
}	

//		giveError();
