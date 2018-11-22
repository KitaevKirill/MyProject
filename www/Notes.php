<?php

//Позднее Статическое Связывание

//Пример 1
class Model {
  public static $table = 'table';
  public static function getTable() {
    return self::$table;
  }
}

class User2 extends Model {
  public static $table = 'users';
}

echo User2::getTable(); // 'table'

//Пример 2
class Model1 {
  public static $table = 'table';
  public static function getTable() {
    return static::$table;
  }
}

class User1 extends Model1 {
  public static $table = 'users';
}

echo User1::getTable(); // 'users'


//Краткая запись IF
expression ? true_value : false_value;

