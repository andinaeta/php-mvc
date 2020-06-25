<?php

require_once APP_PATH . 'core/Exceptions.php';
require_once APP_PATH . 'core/App.php';
require_once APP_PATH . 'core/Controller.php';
require_once APP_PATH . 'core/Database.php';
require_once APP_PATH . 'core/Model.php';
require_once APP_PATH . 'core/Flashdata.php';
require_once APP_PATH . 'core/Functions.php';

require_once APP_PATH . 'config/config.php';

if (file_exists(APP_PATH . 'controllers/BaseController.php')) {
  require_once APP_PATH . 'controllers/BaseController.php';
}
