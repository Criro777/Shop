<?php

namespace vendor\core\base;


abstract class Controller
{
    /*текущий маршрут*/
    protected $route = [];

    /*текущий шаблон*/
    public $layout;


    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Создаёт объект View и вызывает метод для отображения запрашиваемой страницы
     * @param string $view текущий вид
     * @param array $data массив параметов для текущего вида
     */
    public function render($view, $data = [])
    {

            $vObj = new View($this->route, $this->layout, $view);
            $vObj->renderView($data);
    }

}