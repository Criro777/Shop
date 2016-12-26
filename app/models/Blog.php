<?php

namespace app\models;


use vendor\core\base\Model;
use vendor\core\Db;

class Blog extends Model
{
    const TABLE = 'blog';
    const SHOW_BY_DEFAULT = 2;
    const SHOW_BY_PANEL = 3;

    public static function getImage($id, $dir = '')
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        if ($dir == 'mini') {
            $path = '/public/images/mini/';
        } else {
            $path = '/public/images/blog/';
        }
        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        return $path . $noImage;
    }



}