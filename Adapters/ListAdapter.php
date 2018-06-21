<?php
  include_once 'Adapter.php';
  class ListAdapter extends Adapter {
    const TABLE = 'lists';

    public function __construct($link) {
      $this->_link = $link;
    }

    public function getBoardId($boardId) {
      $sql = $this->_link->prepare('SELECT `value` FROM `' . self::TABLE . '` WHERE board=?');
      $sql->bind_param('i', $boardId);
      $sql->execute();
      $result = $sql->get_result();

      return $result;
    }

    public function newList($list, $boardId) {
      $sql = $this->_link->prepare('INSERT INTO `' . self::TABLE . '` (`id`, `value`, `board`) VALUES (NULL,?,?) ');
      $sql->bind_param('ss', $list, $boardId);
      $result = $sql->execute();

      return $result;
    }
  }
?>
