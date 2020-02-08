<?php


class DB {

  public static function getData() {
    return file_get_contents('users.json');
  }

  public static function saveData($data) {
    file_put_contents('users.json', json_encode($data));
  }

}