<?php

if (!session_id()) session_start();

define('APP_PATH', '../app/');

require_once APP_PATH . 'init.php';
$app = new App;
