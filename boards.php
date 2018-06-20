<html>
  <head>
    <title>Boards</title>
  </head>
  <body>
    <h1>Create board</h1>
    <form method="post">
      <label>Board Name:</label>
        <input type="text" name="brd_name">
  <button type="submit" name="new_brd">Create Board</button>
  <br>
  <h1>Your boards:</h1>

  <?php
  $token = $_COOKIE['token'];
  $get_owner = $link->prepare('SELECT `id` FROM `users` WHERE token=?');
  $get_owner->bind_param('i', $token);
  $get_owner->execute();
  $ow = $get_owner->get_result();
  $owner = $ow->fetch_assoc();
  $real_owner = $owner['id'];

  $show_boards = $link->prepare('SELECT * FROM `boards` WHERE owner=?');
  $show_boards->bind_param('i', $real_owner);
  $show_boards->execute();
  $brd_list = $show_boards->get_result();
  while ($show_board = $brd_list->fetch_assoc()){
    echo("<br/>" . "<br/>" . $show_board['name'] . "<br/>" . 'To do list:' . "<br/>");
      $brd_id = $show_board['id'];
      $sql = $link->prepare('SELECT `value` FROM `lists` WHERE board=?');
      $sql->bind_param('i', $brd_id);
      $sql->execute();
      $res = $sql->get_result();
      while ($row = $res->fetch_assoc()) {
        echo("<br/>" . $row['value']);
      }
      echo("<br/>");
    }


  if (isset($_POST['new_brd'])) {
    $name = $_POST['brd_name'];
    $sql = $link->prepare('INSERT INTO `boards`(`id`, `name`, `owner`) VALUES (NULL,?,?) ');
    $sql->bind_param('si', $name, $real_owner);
    $result = $sql->execute();
    $page = $_SERVER['PHP_SELF'];
    echo '<meta http-equiv="Refresh" content="0;' . $page . '">';

  }
  ?>

  </body>
</html>
