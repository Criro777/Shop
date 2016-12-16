<?php
/**
 * Точка входа на сайт
 */
use vendor\core\Router;
require '../vendor/components/TreeCategory.php';
require '../vendor/autoload.php';
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'main');
$query = $_SERVER['QUERY_STRING'];
/*маршруты по умолчанию*/
Router::add('^$', ['controller' => 'Site', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<parameter>[0-9]+)?$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
/*поиск текущего маршрута*/
Router::dispatch($query);