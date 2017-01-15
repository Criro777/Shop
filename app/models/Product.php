<?php

namespace app\models;

use vendor\core\base\Model;
use vendor\core\Db;

/**
 * Класс Product - модель для работы с товарами
 */
class Product extends Model
{
    const SHOW_BY_DEFAULT = 3;
    const SHOW_BY_PANEL = 8;
    const TABLE = 'product';

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */

    public static function getImage($id, $dir = '')
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        if ($dir == 'mini') {
            $path = '/public/images/mini/';
        } else {
            $path = '/public/images/products/';
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

    public static function getCurrentPrice($price)
    {
        if (!(isset($_SESSION['selectMoney'])) or $_SESSION['selectMoney'] == 'dollar') {
            return $price . '$';
        } else {
            return $price * 0.96 . '€';
        }

    }


}