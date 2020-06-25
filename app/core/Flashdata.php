<?php

class Flashdata
{
  public static function set($name, $data)
  {
    $_SESSION['flashdata'][$name] = $data;
  }

  public static function flash($name)
  {
    if (isset($_SESSION['flashdata'][$name])) {
      echo $_SESSION['flashdata'][$name];
      unset($_SESSION['flashdata'][$name]);
    }
  }
}
