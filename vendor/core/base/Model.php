<?php

namespace vendor\core\base;


use vendor\core\Db;

abstract class Model
{
    const TABLE = '';
    const SHOW_BY_DEFAULT = 3;
    const SHOW_BY_PANEL = 7;
    protected $data = [];

    /**
     * Обрабатывает данные от формы и записывает их в модель
     * @param $arr <p>Массив внешних данных от пользователя</p>
     */

    public function fillPostData($arr)
    {
        foreach ($arr as $key => $item) {

            $this->data[$key] = trim(strip_tags($item));
        }

    }

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


    public function getColumn($column)
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = "SELECT * FROM "  . static::TABLE;
        $result = $db->queryOne($sql);
        return $result;

    }

    /**
     * Возвращает запись из таблицы базы данных в виде объекта класса  с заданным id
     * @param integer $id <p>id объекта класса</p>
     * @return array <p>Массив с информацией об объекте класса</p>
     * @throws \Exception
     */


    public static function getItemById($id)
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $result = $db->query($sql, [':id' => $id]);
        if (!$result) {
            
            throw new \Exception();
        }
        return $result;

    }
    
    /**
     * Возвращает запись из таблицы базы данных в виде объекта класса  по заданному параметру
     * @param $field <p>Поле в таблице БД</p>
     * @param $param <p>Параметр поиска</p>
     * @return array <p>Массив с информацией об объекте класса</p>
     * @throws \Exception
     */

    public static function getItemByParam($field, $param)
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = "SELECT * FROM  " . static::TABLE . " WHERE $field = ?";
        $result = $db->query($sql, [$param]);
        if (!$result) {

            throw new \Exception();
        }
        return $result;

    }

    /**
     * Возвращает построчно $count последних записей из таблице
     * @param int $count <p>Количество</p>
     * @return array <p>Массив из $count объектов класса</p>
     */

    public static function getLimitItems($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'SELECT * FROM ' . static::TABLE . ' LIMIT ' . $count;
        $result = $db->query($sql);
        return $result;
    }

    /**
     * Получает объекты из таблицы, у котороых значение поля $field  совпадает с каким-либо значением из списка $list_params
     * @param $field <p>поле таблицы</p>
     * @param $list_params <p>список параметров для сравнения</p>
     * @return array $result массив объектов с заднными параметрами
     */
    public static function getItemsInList($field, $list_params)
    {
        $db = Db::instance();
        $list = implode(',', $list_params);

        $sql = "SELECT * FROM " .static ::TABLE ." WHERE $field IN ($list)";

        $result = $db->query($sql);

        return $result;

    }

    /**
     * Получает количество записей, отображаемых на одной странице при пагинации
     * @param bool $field <p>поле таблиы или false, если не требуется</p>
     * @param bool $value <p>значение поля поле таблиы или false, если не требуется</p>
     * @param int $page <p>номер страницы</p>
     * @return array массив объектов из БД
     */

    public static function getItemsInPage($field = false,$value = false, $page = 1)
    {
        $db = Db::instance();
        if ($value && $field) {
            $offset = ($page - 1) * static::SHOW_BY_DEFAULT;

            $sql = "SELECT * FROM " . static::TABLE . " WHERE " . $field . " LIKE ?"
                . "ORDER BY id ASC  LIMIT " . static::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset;
            $result = $db->query($sql, ['%' . $value . '%']);
           // return $result;
        }else {
            $offset = ($page - 1) * static::SHOW_BY_PANEL;

            $sql = "SELECT * FROM " . static::TABLE
                . " ORDER BY id ASC "
                . "LIMIT " . static::SHOW_BY_PANEL
                . ' OFFSET ' . $offset;
            $result = $db->query($sql);

        }
        return $result;
    }

    /**
     * Возвращает количество объектов в таблице БД
     * @param string $field <p>поле таблиы или false, если не требуется</p>
     * @param string $value <p>значение поля поле таблиы или false, если не требуется</p>
     * @return int
     */

    public static function Count($field = false, $value = false)
    {

        if($field){

        $sql = 'SELECT COUNT(id) AS count FROM '. static::TABLE .' WHERE '.$field. ' LIKE ?' ;

        } else{

            $sql = 'SELECT COUNT(id) AS count FROM ' . static::TABLE;
        }
        $result = Db::instance()->queryCount($sql,['%'.$value.'%']);

        return $result;
    }

    /**
     * Добавляет новую запись в таблицу базы данных
     * @return integer <p>id добавленной в таблицу записи</p>
     */

    public function createItem($flag = 0)
    {
        $columns = [];
        $params = [];
        foreach ($this->data as $k => $v) {
            if ($k == 'create')
                continue;
            $columns[] = $k;
            $params[':' . $k] = $v;
        }
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'INSERT INTO ' . static::TABLE . '(' . implode(',', $columns) . ')VALUES(' . implode(',', array_keys($params)) . ') ';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->execute($sql, $params, $flag);

        if($flag) {

            return $result;
        }

    }

    /**
     * Редактирование объекта класса с заданным id
     * @return boolean <p>Результат выполнения метода</p>
     */

    public function updateItem()
    {
        // Соединение с БД
        $places = [];
        $params = [];

        foreach ($this->data as $k => $v) {
            if ($k == 'update' or  $k == 'action')
                continue;
            $places[] = $k . '=:' . $k;
            $params[':' . $k] = $v;
        }

        $db = Db::instance();
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $places) . ' WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->execute($sql, $params);

        return $result;
    }

    /**
     * Удаление объекта класса с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */

    public function deleteItem($id)
    {
        // Соединение с БД
        $db = Db::instance();
        // Текст запроса к БД
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->execute($sql, [':id' => $id]);
        return $result;
    }
}