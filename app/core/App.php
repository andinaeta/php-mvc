<?php

class App
{
  protected $controller = DEFAULT_CONTROLLER;
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseURL();

    if (isset($url[0])) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    if (!file_exists(APP_PATH . 'controllers/' . $this->controller . '.php')) {
      $message = "app/controllers/$this->controller.php doesn't exist";
      return Exceptions::PageNotFoundException($message);
    }

    require_once APP_PATH . 'controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1]) && method_exists($this->controller, $url[1])) {
      $this->method = $url[1];
      unset($url[1]);
    }

    if (!method_exists($this->controller, $this->method)) {
      $message = "Controller method $this->method not found";
      return Exceptions::PageNotFoundException($message);
    }

    if (!empty($url)) {
      $this->params = array_values($url);
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseURL()
  {
    if (isset($_GET['url'])) {
      $url = $_GET['url'];
      $url = rtrim($url, '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
