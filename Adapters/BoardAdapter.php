<?php
  include_once 'Adapter.php';
  class BoardAdapter extends Adapter {
    const TABLE = 'boards';

    public function __construct($link) {
      $this->_link = $link;
    }

    public function createNewBoard($ownerId, $name) {
      $sql = $this->_link->prepare('INSERT INTO `' . self::TABLE . '`(`id`, `name`, `owner`) VALUES (NULL,?,?) ');
      $sql->bind_param('si', $name, $ownerId);
      $result = $sql->execute();

      return $result;
    }

    public function showBoards($real_owner) {
      $sql = $this->_link->prepare('SELECT * FROM `' . self::TABLE . '` WHERE owner=?');
      $sql->bind_param('i', $real_owner);
      $sql->execute();

      return $sql;
    }
}
  ?>
