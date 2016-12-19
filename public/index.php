<?php
/**
 * Точка входа на сайт
 */
use vendor\core\Router;
require '../vendor/components/TreeCategory.php';
require '../vendor/components/Pagination.php';
require '../vendor/autoload.php';
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'main');

session_start();

$query = trim($_SERVER['REQUEST_URI'], '/');

if(isset($_COOKIE['idUser'])){
    $_SESSION['user'] = base64_decode($_COOKIE['idUser']);

}

/* маршруты для контроллера Category*/
Router::add('^category/(?P<parameter>[0-9]+)/page/?(?P<page>[0-9]+)?$',['controller' => 'Category','action' => 'index']);
Router::add('^category/(?P<parameter>[0-9]+)$',['controller' => 'Category', 'action' => 'index']);

/* маршруты для контроллера Product*/
Router::add('^product/(?P<action>[a-z-]+)/(?P<parameter>[0-9]+)$', ['controller' => 'Product']);
Router::add('^product/(?P<parameter>[0-9]+)$', ['controller' => 'Product','action' => 'view']);

/*маршруты по умолчанию*/
//Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/(?P<parameter>[0-9]+)/?(?P<page>[a-z0-9]+)?$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/(?P<parameter>[0-9]+)$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
Router::add('^$', ['controller' => 'Site', 'action' => 'index']);


/*поиск текущего маршрута*/
Router::dispatch($query);