<?php
require("../lib/database.php");
  $sql = "
  INSERT INTO topic
    (description, created, user_no)
    VALUES(
      '{$_POST['description']}',
      NOW(),
      '{$_POST['no']}'
    )
  ";   
  $result = mysqli_query($conn, $sql);
  header('Location: ./main_feed.php');
?>