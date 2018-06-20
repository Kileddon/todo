<?php
  include_once 'Adapter.php';
  class UserAdapter extends Adapter {
    const TABLE = 'users';

    public function __construct($link) {
      $this->_link = $link;
    }

    public function createNewUser($login, $password, $email) {
      $sql = $this->_link->prepare('INSERT INTO `' . self::TABLE . '`(`id`, `login`, `email`, `password`) VALUES (NULL,?,?,?)');
      $sql->bind_param('sss', $login, $email, $password);
      $result = $sql->execute();

      return $result;
    }

    public function userLogin($login, $password) {
      $sql = $this->_link->prepare('SELECT * FROM `' . self::TABLE . '` WHERE login=? AND password=?');
      $sql->bind_param('ss', $login, $password);
      $result = $sql->execute();

      if ($result) {
        return $sql;
      }
      return false;
    }

    public function updateToken($id, $token) {
      $sql = $this->_link->prepare('UPDATE `' . self::TABLE . '` SET `token` =? WHERE `id` =?');
      $sql->bind_param('si', $token, $id);
      $sql->execute();
    }

    public function getIdByToken($token) {
      $sql = $this->_link->prepare('SELECT `id` FROM `' . self::TABLE . '` WHERE token=?');
      $sql->bind_param('i', $token);
      $result = $sql->execute();
      if ($result) {
        $owner = $sql->get_result();
        $row = $owner->fetch_assoc();
        return $row['id'];
      }

      return false;
    }
  }
