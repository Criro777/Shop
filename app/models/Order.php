<?php

namespace app\models;

use vendor\core\base\Model;
use vendor\core\Db;

/**
 * Класс Order - модель для работы с заказами
 */
class Order extends Model
{
    const TABLE = 'product_order';

    /**
     * Сохранение заказа
     * @param string $userName <p>Имя</p>
     * @param string $userPhone <p>Телефон</p>
     * @param string $userComment <p>Комментарий</p>
     * @param integer $userId <p>id пользователя</p>
     * @param array $products <p>Массив с товарами</p>
     * @return boolean <p>Результат выполнения метода</p>
     */

    public function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);

        $db = Db::instance();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products, status) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products, :status)';

        $result = $db->execute($sql, [':user_name' => $userName, ':user_phone' => $userPhone, ':user_comment' => $userComment,
            ':user_id' => $userId, ':products' => $products,'status' => 1]);
        
        return $result;
    }

    /**
     * Возвращает текстое пояснение статуса для заказа :<br/>
     * <i>1 - Новый заказ, 2 - В обработке, 3 - Обработан</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'Заказ в обработке';
                break;
            case '3':
                return 'Заказ обработан';
                break;

        }
    }
}