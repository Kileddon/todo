<?php
function db(){
  global $link;
  $link = mysqli_connect ("localhost", "root", "", "todo") or die ("couldn't connect to db");
}
 ?>
