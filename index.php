<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'max_execution_time', 300 );
// change the following paths if necessary
$yii    = 'vendor/yii/framework/yii.php';
$config = dirname( __FILE__ ) . '/protected/config/main.php';
ini_set( 'mongo.long_as_object', 1 );
// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);
define( 'YII_DEBUG', true );
date_default_timezone_set( 'Europe/Moscow' );
require_once( $yii );
Yii::createWebApplication( $config )->run();