<?php

class Flashdata
{
  public static function setFlash($data)
  {
    $_SESSION['flashdata'] = $data;
  }

  public static function flash()
  {
    if (isset($_SESSION['flashdata'])) {
      echo $_SESSION['flashdata'];
      unset($_SESSION['flashdata']);
    }
  }
}
