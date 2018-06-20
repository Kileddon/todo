<html>
    <?php
    include 'connect.php';
    include 'sendtoserver.php';
    ?>
  <head>
    <meta>
    <title>To do list</title>
  </head>
  <body>
    <?php if (isset($_COOKIE['token'])) {
      include 'logout.php';
      include 'boards.php';
    }
    else {
      include 'register.php';
      include 'login.php';
    }
    ?>
  </body>
</html>
