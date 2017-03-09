<?php

namespace app\models;


use vendor\core\base\Model;
use vendor\core\Db;

class Category extends Model
{
    const TABLE = 'category';

    /**
     * Получение списка категорий из таблицы БД
     * @return array
     */
    public static function getListCategory()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        $result = $db->queryEach($sql, 'id');
        return $result;
        
    }
    
}