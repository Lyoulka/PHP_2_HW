<?php
function counters($dbh, $id, $counter){
          $query = "SELECT `".$counter."` FROM pictures WHERE `id` = " . $id;
          $resDB = $dbh->query($query);
          $count = $resDB->fetchObject();
          $number = $count->$counter + 1;
          $query = "UPDATE pictures SET `".$counter."` = " . $number . " WHERE `id` = " . $id;
          $dbh->query($query);
    }
