<?php
date_default_timezone_set('Asia/Kolkata');

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// DB
define("DB_HOST", $_ENV['DB_HOST']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASS", $_ENV['DB_PASS']);
define("DB_NAME", $_ENV['DB_NAME']);

// PHPMailer
define("MAIL_USER", $_ENV['MAIL_USER']);
define("MAIL_PASS", $_ENV['MAIL_PASS']);

?>