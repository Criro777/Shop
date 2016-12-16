<?php

namespace vendor\core;

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
                return true;
            }
        }
        return false;
    }

    /**
     * Перенаправляет URL по корректному маршруту
     * @param string $url входящий URL
     * @return void
     */
    public static function dispatch($url)
    {
        //$url = self::removeQueryString($url);
        try {
            if (self::matchRoute($url)) {

                $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
                if (class_exists($controller)) {
                    $cObj = new $controller(self::$route);
                    $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                    $parameters = self::$route['parameter'];
                    if (method_exists($cObj, $action)) {
                        $cObj->$action($parameters);
                    } else {
                        throw new \Exception();
                    }
                } else {
                    throw new \Exception();
                }
            }
        } catch (\Exception $e) {
            http_response_code(404);
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