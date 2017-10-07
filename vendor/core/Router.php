<?php

namespace vendor\core;

use app\controllers\ErrorController;

/**
 * Класс Router для работы с маршрутами
 */
class Router
{
    /**
     *таблица маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     * текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     * добавляет маршрут в таблицу маршрутов
     * @param string регулярное выражение маршрута
     * @param array $route маршрут ([controller, action, params])
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * возвращает таблицу маршрутов
     * @return array $routes
     */

    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * возвращает текущий маршрут ([controller, action, params])
     * @return array $route
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return bool
     */

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("~$pattern~i", $url, $matches)) {
                //debug($matches);

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }

                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                //var_dump($route);
                return true;
            }
        }
        return false;
    }

    /**
     * Перенаправляет URL по корректному маршруту
     * @param string $url входящий URL
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);

        try {

            if (self::matchRoute($url)) {

                $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
                if (class_exists($controller)) {
                    $cObj = new $controller(self::$route);
                    $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                    $parameters = self::$route['parameter'];
                    $page = self::$route['page'];

                    if (is_callable([$cObj, $action])) {
                        $cObj->$action($parameters, $page);
                    } else {

                        throw new \Exception();
                    }
                } else {

                    throw new \Exception();
                }
            }
        } catch (\Exception $e) {

            $controller = new ErrorController(['controller' => 'Error', 'action' => 'index']);
            $action = $controller->indexAction();
        }

    }

    /**
     * Преобразует первую букву имени к верхнему регистру
     * @param string $name
     * @return string $name
     */

    public static function upperCamelCase($name)
    {
        return $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    public static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * Обрезает GET- параметры у URL
     * @param $url
     * @return string
     */

    public static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }

}