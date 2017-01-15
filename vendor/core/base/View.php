<?php

namespace vendor\core\base;


class View
{
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;

    /**
     * Инициализация начальный настроек вида
     * @param $route путь к файлу вида(директория/файл)
     * @param string $layout текущий шаблон
     * @param string $view текущий файл вида
     */
    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;

    }

    /**
     * Функция отображения текущего вида  страницы
     * @param array $data массив параметов для текущего вида
     */
    public function renderView($data = [])
    {
        extract($data);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";

        ob_start();
        require $file_view;
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "<p>Не найден шаблон <b>$file_layout</b></p>";
            }
        }

    }
}