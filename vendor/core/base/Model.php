<?php

namespace vendor\core\base;


use vendor\core\Db;

abstract class Model
{
    const TABLE = '';

    /**
     * Возвращает построчно записи из таблицы базы данных в виде объекта класса посредством генератора
     * @return array <p>Массив объектов</p>
     */

    public static function getListItem()
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'SELECT * FROM ' . static::TABLE;
        $result = $db->query($sql);
        return $result;

    }

    /**
     * Возвращает запись из таблицы базы данных в виде объекта класса  с заданным id
     * @param integer $id <p>id объекта класса</p>
     * @return array <p>Массив с информацией об объекте класса</p>
     */

    public static function getItemById($id)
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $result = $db->query($sql, [':id' => $id]);
        if(!$result){
            throw new \Exception();
        }
        return $result;

    }

    /**
     * Возвращает построчно $count последних записей из таблице в виде объектов класса посредством генератора
     * @param type $count [optional] <p>Количество</p>
     * @return array <p>Массив из $count объектов класса</p>
     */

    public static function getCountItems($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'SELECT * FROM ' . static::TABLE . ' LIMIT ' . $count;
        $result = $db->query($sql);
        return $result;


    }
}