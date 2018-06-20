<?php
if (isset($_POST['reg_user'])) {
  $userAdapter = new UserAdapter($link);
  $login = $_POST['login'];
  $password = hash('sha512', $_POST['password'] . SALT);
  $email = $_POST['email'];

  $result = $userAdapter->createNewUser($login, $password, $email);

  if ($result) {
    echo 'Hello, ' . $login;
  }
  else {
    echo 'rip';
  }
}
 elseif (isset($_POST['log_user'])) {
   $userAdapter = new UserAdapter($link);
   $login = $_POST['login'];
   $password = hash('sha512', $_POST['password'] . SALT);

   $result = $userAdapter->userLogin($login, $password);

   if ($result) {
     $res = $result->get_result();
     $row = $res->fetch_assoc();
     if (!$row) {
       return;
     }
     echo 'Hello, ' . $login;

     $token = hash('sha512', $row['id'] . time() . SALT);
     setcookie('token', $token);
     $userAdapter->updateToken($row['id'], $token);

     $page = $_SERVER['PHP_SELF'];
     echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
   }
 }
 ?>
