<h1>Create board</h1>
<form method="post">
  <label>Board Name:</label>
  <input type="text" name="brd_name">
  <button type="submit" name="new_brd">Create Board</button>
  <br>
  <h1>Your boards:</h1>

  <?php
    include_once 'Adapters/BoardAdapter.php';
    include_once 'Adapters/ListAdapter.php';
    $boardAdapter = new BoardAdapter($link);
    $listAdapter = new ListAdapter($link);

    if (isset($_POST['new_brd'])) {
      $name = $_POST['brd_name'];
      $boardAdapter->createNewBoard($real_owner, $name);
      $page = $_SERVER['PHP_SELF'];
      echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
    }
    elseif (isset($_GET['board_id'])) {
      $boardId = intval($_GET['board_id']);
      $result = $listAdapter->getBoardId($boardId);
      while ($row = $result->fetch_assoc()) {
        echo"<br>" . $row['value'];
      }
      if (isset($_POST['new_list'])) {
        $list = $_POST['note'];
        $listAdapter->newList($list, $boardId);
        $page = $_SERVER['PHP_SELF'] . '?board_id=' . $boardId;
        echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
     }
      else {
        include_once 'lists.php';
      }
    }
    echo'<br>';
    $sql = $boardAdapter->showBoards($real_owner);
    $result = $sql->get_result();
    while ($sql = $result->fetch_assoc()){
      $brdId = $sql['id'];
      echo '<a href="?board_id=' . $brdId . '">' . $sql['name'] . '</a> <br>';
      echo"<br>";
    }
  ?>
