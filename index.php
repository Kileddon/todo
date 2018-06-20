<html>
  <?php
    include 'connect.php';
    include_once 'Adapters/UserAdapter.php';
    include 'sendtoserver.php';
  ?>
  <head>
    <title>To do list</title>
  </head>
  <body>
    <?php
      if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $userAdapter = new UserAdapter($link);
        $real_owner = $userAdapter->getIdByToken($token);

        if (!$real_owner) {
          include_once 'register.php';
          include_once 'login.php';
          setcookie ("token", "", time() - 3600);
          unset($_COOKIE['token']);
          return;
        }
        include_once 'logout.php';
        include_once 'boards.php';
       }
      else {
        include_once 'register.php';
        include_once 'login.php';
      }
    ?>
  </body>
</html>
