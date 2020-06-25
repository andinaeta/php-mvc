<?php

class Exceptions
{
  public static function PageNotFoundException($message = '')
  {
    if (ENVIRONMENT == 'production') redirect('/');
    require_once APP_PATH . 'core/404.php';
  }

  public static function CustomException($title, $message)
  {
    if (ENVIRONMENT == 'production') return null;
    require_once APP_PATH . 'core/custom_exception.php';
  }
}
