<html>
  <?php include 'connect.php'?>
  <head>
    <title>Lists</title>
  </head>
  <body>
    <h2>To do:</h2>
    <form method="post">
      <label>Note:</label>
        <input type="text" name="note">
      <label>Board:</label>
        <input type="number" step="1" name="board">
  <button type="submit" name="new_list">Remember</button>

  <?php if (isset($_POST['new_list'])) {
    $list = $_POST['note'];
    $board = $_POST['board'];
    $sql = $link->prepare('INSERT INTO `lists`(`id`, `value`, `board`) VALUES (NULL,?,?) ');
    $sql->bind_param('ss', $list, $board);
    $result = $sql->execute();
  }
  ?>
  <br>
  <form method="post">
    <label>Board</label>
    <input type"number" step="1" name="brd">
  <button type="submit" name="get_list">Remind me</button>

  <?php if (isset($_POST['get_list'])) {
    $board = $_POST['brd'];
    $sql = $link->prepare('SELECT `value` FROM `lists` WHERE board=?');
    $sql->bind_param('i', $board);
    $sql->execute();
    $res = $sql->get_result();
    while ($row = $res->fetch_assoc())
    echo("<br/>" . $row['value']);
  }  ?>
  </body>
</html>
