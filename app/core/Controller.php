<?php

class Controller
{
  public function view($view, $data = [])
  {
    if (!file_exists(APP_PATH . 'views/' . $view . '.php')) {
      $message = "app/views/$view.php doesn't exist";
      return Exceptions::PageNotFoundException($message);
    }

    if (!empty($data)) extract($data);

    require_once APP_PATH . 'views/' . $view . '.php';
  }

  public function model($model)
  {
    if (!file_exists(APP_PATH . 'models/' . $model . '.php')) {
      $message = "app/models/$model.php doesn't exist";
      return Exceptions::PageNotFoundException($message);
    }

    require_once APP_PATH . 'models/' . $model . '.php';
  }

  public function library($library)
  {
    if (!file_exists(APP_PATH . 'libraries/' . $library . '.php')) {
      $message = "app/libraries/$library.php doesn't exist";
      return Exceptions::PageNotFoundException($message);
    }

    require_once APP_PATH . 'libraries/' . $library . '.php';
  }

  public function helper($helper)
  {
    if (!file_exists(APP_PATH . 'helpers/' . $helper . '_helper.php')) {
      $message = "app/helpers/$helper" . "_helper.php doesn't exist";
      return Exceptions::PageNotFoundException($message);
    }

    require_once APP_PATH . 'helpers/' . $helper . '_helper.php';
  }
}
