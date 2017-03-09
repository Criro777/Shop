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

    public static function check_ip($ip , $id)
    {
        $db = Db::instance();
        $sql = "SELECT * FROM ip_rating WHERE ip=? AND blog_id =?";
        $result = $db->query($sql,[$ip, $id]);
        

        return $result;

    }

    public function add_ip($ip, $blog_id)
    {
        $db = Db::instance();
        $sql = 'INSERT INTO ip_rating(ip, blog_id) VALUES (:ip, :blog_id)';
        $result = $db->execute($sql, [':ip' => $ip, ':blog_id' => $blog_id]);
        return $result;
    }



}