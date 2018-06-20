<?php

if (isset($_POST['reg_user'])) {
  $login = $_POST['login'];
  $password = hash('sha512', $_POST['password'] . SALT);
  $email = $_POST['email'];
  $sql = $link->prepare('INSERT INTO `users`(`id`, `login`, `email`, `password`) VALUES (NULL,?,?,?)');
  $sql->bind_param('sss', $login, $email, $password);
  $result = $sql->execute();
  if ($result) {
    echo 'Hello, ' . $login;
  }
  else {
    echo 'rip';
  }
}
 elseif (isset($_POST['log_user'])) {
   $login = $_POST['login'];
   $password = hash('sha512', $_POST['password'] . SALT);
   $sql = $link->prepare('SELECT * FROM `users` WHERE login=? AND password=?');
   $sql->bind_param('ss', $login, $password);
   $result = $sql->execute();
   if ($result) {
     $res = $sql->get_result();
     $row = $res->fetch_assoc();
     if (!$row) {
       return;
     }
     echo 'Hello, ' . $login;
     $token = hash('sha512', $row['id'] . time() . SALT);
     setcookie('token', $token);
     $upd_token = $link->prepare('UPDATE `users` SET `token` =? WHERE `id` =?');
     $upd_token->bind_param('si', $token, $row['id']);
     $upd_token->execute();
     $page = $_SERVER['PHP_SELF'];
     echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
   }
 }
 ?>
