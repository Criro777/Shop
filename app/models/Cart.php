<?php

/**
 * Класс Cart
 * Модель для работы с корзиной
 */
namespace app\models;


use vendor\core\base\Model;

class Cart extends Model
{

    /**
     * Добавление товара в корзину (сессию)
     * @param int $id <p>id товара</p>
     * @return integer <p>Количество товаров в корзине</p>
     */
    
    //protected  $productsInCart = [];
    public function addProductToCart($id, $amount = 1)
    {
        // Пустой массив для товаров в корзине
        $productsInCart = [];

        // Если в корзине уже есть товары (хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // Заполняем массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если такой товар уже есть в корзине
        if (array_key_exists($id, $productsInCart)) {

            // Если такой товар есть в корзине, но был добавлен еще , увеличим количество на величину $amount

            $productsInCart[$id] += $amount;
        } else {

            // Если нет, добавляем id нового товара в корзину в количестве $amount
            $productsInCart[$id] = $amount;
        }

        // Записываем массив с товарами в сессию
        $_SESSION['products'] = $productsInCart;

        // Возвращаем количество товаров в корзине
        return self::countItems();
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int <p>Количество товаров в корзине</p>
     */

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return '(' .$count . ')';
        } else {
            return '(' . 0 .  ')';
        }
    }

    /**
     * Возвращает массив с идентификаторами и количеством товаров в корзине<br/>
     * Если товаров нет, возвращает false;
     * @return mixed: boolean or array
     */

    public static function getProductsInCart()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Получаем общую стоимость переданных товаров
     * @param array $products <p>Массив с информацией о товарах</p>
     * @return integer <p>Общая стоимость</p>
     */

    public static function getTotalPrice($products)
    {
        //получаем список товаров в корзине из сессии
        $productsInCart = self::getProductsInCart();
        $total = 0;
        //вычисляем общую стоимость товаров
        //if ($productsInCart) {
        foreach ($products as $item) {
            $total += $item->price * $productsInCart[$item->id];
        }
        //}
        return $total;
    }

    /**
     * Очистка корзину
     */

    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
            return self::countItems();
        }
    }

    /**
     * Удаление товара с указанным id из корзины
     * @param integer $id <p>id товара</p>
     */

    public static function deleteOneProduct($id)
    {
        $productsInCart = self::getProductsInCart();
        if ($productsInCart[$id] == 1) {
            unset($productsInCart[$id]);


        } else {
            $productsInCart[$id]--;
        }
        $_SESSION['products'] = $productsInCart;

        //return $productsInCart;
    }


}