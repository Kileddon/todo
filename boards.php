<h1>Create board</h1>
<form method="post">
  <label>Board Name:</label>
  <input type="text" name="brd_name">
  <button type="submit" name="new_brd">Create Board</button>
  <br>
  <h1>Your boards:</h1>

  <?php
    include_once 'Adapters/BoardAdapter.php';
    $boardAdapter = new BoardAdapter($link);

    if (isset($_POST['new_brd'])) {
      $name = $_POST['brd_name'];
      $boardAdapter->createNewBoard($real_owner, $name);
      $page = $_SERVER['PHP_SELF'];
      echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
    }
    elseif (isset($_GET['board_id'])) {
      $boardId = intval($_GET['board_id']);
      $sql = $link->prepare('SELECT `value` FROM `lists` WHERE board=?');
      $sql->bind_param('i', $boardId);
      $sql->execute();
      $res = $sql->get_result();
      while ($row = $res->fetch_assoc()) {
        echo"<br>" . $row['value'];
      }
      if (isset($_POST['new_list'])) {
        $list = $_POST['note'];
        $sql = $link->prepare('INSERT INTO `lists`(`id`, `value`, `board`) VALUES (NULL,?,?) ');
        $sql->bind_param('ss', $list, $boardId);
        $result = $sql->execute();
        $page = $_SERVER['PHP_SELF'] . '?board_id=' . $boardId;
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
     }
      else {
        include_once 'lists.php';
      }
    }
    echo'<br>';
    $show_boards = $link->prepare('SELECT * FROM `boards` WHERE owner=?');
    $show_boards->bind_param('i', $real_owner);
    $show_boards->execute();
    $brd_list = $show_boards->get_result();
    while ($show_board = $brd_list->fetch_assoc()){
      $brd_id = $show_board['id'];
      echo '<a href="?board_id=' . $brd_id . '">' . $show_board['name'] . '</a> <br>';
      echo"<br>";
    }
  ?>
