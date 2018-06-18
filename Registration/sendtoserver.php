<?php include "../connect.php";

if (isset($_POST['reg_user'])) {
  $login = $_POST['login'];
  $password = hash('sha512', $_POST['password'] . SALT);
  $email = $_POST['email'];
  $sql = $link->prepare('INSERT INTO `users`(`id`, `login`, `email`, `password`) VALUES (NULL,?,?,?)');
  $sql->bind_param('sss', $login, $email, $password);
  $result = $sql->execute();
  if ($result) {
    echo 'ok ' . $login;
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
     if (!$res) {
       return;
     }
     echo 'ok ' . $login;

   }
 }

?>
