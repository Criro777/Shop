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
    const TABLE = 'product';

    public static function getProductsInCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
            $db = Db::instance();
            $products = [];
            $sql = "SELECT * FROM product "
                . "WHERE category_id = '$categoryId' "
                . "ORDER BY id ASC "
                . "LIMIT " . self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset;
            $result = $db->query($sql);
            //if(!$result){
                //throw new \Exception();
            //}

            return $result;
        }
    }

    public static function getProductsByIds($idsArray)
    {
        $db = Db::getConnection();
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        $products = $result->fetchAll(\PDO::FETCH_CLASS, Product::class);

        return $products;

    }

    public static function getCountProductsInCategory($categoryId)
    {
        $db = Db::instance();
        $sql = 'SELECT COUNT(id) AS count FROM product WHERE category_id = "' . $categoryId . '"';
        $result = $db->queryCount($sql);

        return $result;
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */

    public static function getImage($id, $dir='')
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        if($dir == 'mini'){
            $path = '/public/images/mini/';
        }
        else {
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


}