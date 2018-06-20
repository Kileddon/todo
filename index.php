<html>
  <?php
    include 'connect.php';
    include 'sendtoserver.php';
  ?>
  <head>
    <title>To do list</title>
  </head>
  <body>
    <?php if (isset($_COOKIE['token'])) {
      $token = $_COOKIE['token'];
      $get_owner = $link->prepare('SELECT `id` FROM `users` WHERE token=?');
      $get_owner->bind_param('i', $token);
      $get_owner->execute();
      if ($get_owner) {
        $ow = $get_owner->get_result();
        $owner = $ow->fetch_assoc();
        if (!$owner) {
          include_once 'register.php';
          include_once 'login.php';
          setcookie ("token", "", time() - 3600);
          unset($_COOKIE['token']);
          return;
        }
        $real_owner = $owner['id'];
        include_once 'logout.php';
        include_once 'boards.php';
      }
    }
    else {
      include_once 'register.php';
      include_once 'login.php';
    }
    ?>
  </body>
</html>
