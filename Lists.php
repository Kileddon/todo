<html>
  <head>
    <title>Lists</title>
  </head>
    <body>
      <form method="post">
        <label>Note:</label>
          <input type="text" name="note">
  <button type="submit" name="new_list">Remember</button>

  <?php if (isset($_POST['new_list'])) {
    $list = $_POST['note'];
    $sql = $link->prepare('INSERT INTO `lists`(`id`, `value`, `board`) VALUES (NULL,?,?) ');
    $sql->bind_param('ss', $list, $brd_id);
    $result = $sql->execute();
  }
  ?>
  </body>
</html>
