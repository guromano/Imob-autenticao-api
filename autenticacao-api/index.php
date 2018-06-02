<?php

require_once __DIR__ . '/vendor/autoload.php';
require "Controller/LoginController.php";

$app = new Slim\App();

$loginController = new LoginController();
$app->POST('/login', [$loginController, 'Login']);

$app->run();
