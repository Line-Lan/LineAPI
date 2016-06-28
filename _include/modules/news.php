<?php

openSql();
// /api/news/
switch ($q[1]) {
   case NULL:
      $result = $sql->query('Select news_article, headline from news where hide_item = 0', MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ('<b>' . $row['headline'] . '</b><br/>');
         echo htmlspecialchars_decode($row['news_article']);
         echo ('<br/><br/>');
      }
      break;
   // /api/news/x/
   default:
      if (!is_numeric($q[1])) {
         giveRequestError();
      }
   
      $q[1] = $sql->real_escape_string($q[1]);
      $result = $sql->query('Select news_article, headline from news where hide_item = 0 and itemid=' . $q[1], MYSQLI_USE_RESULT);
      while ($row = $result->fetch_assoc()) {
         echo ('<b>' . $row['headline'] . '</b><br/>');
         echo htmlspecialchars_decode($row['news_article']);
      }
      break;
}
