<?php

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\Product;
use app\models\User;

class CartController extends AppController
{

    /**
     * Добавление товара в корзину при помощи асинхронного запроса (ajax)
     * @param integer $id <p>id товара</p>
     * @return bool
     */

    public function countAction()
    {

        echo Cart::countItems();
    }

    public function addAction($id)
    {
        // Добавляем товар в корзину
        $cart = new Cart();
        //Определяем количество выбранной единицы товара
        if (isset($_POST['quantity'])) {

            echo $cart->addProductToCart($id, $_POST['quantity']);

        } else {

            echo $cart->addProductToCart($id);
        }

    }

    /**
     * Отображение вида для страницы "Корзина"
     */

    public function indexAction()
    {

        //$this->layout = 'default';
        $productsInCart = Cart::getProductsInCart();
        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getItemsInList('id',$productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }
        $this->render('index', [
            'products' => $products, 'productsInCart' => $productsInCart,
            'totalPrice' => $totalPrice]);
    }

    /**
     * Удаление товаров из корзины по одному
     * @param string $productId идентификатор товара
     */

    public function deleteAction($productId)
    {
        $this->layout = 'default';

        Cart::deleteOneProduct($productId);
        self::indexAction();
    }

    /**
     * Очистка корзины
     */

    public function clearAction()
    {
        $this->layout = 'default';
        Cart::clear();
        self::indexAction();

    }

    /**
     * Отображение вида страницы "Оформление покупки"
     */

    public function checkoutAction()
    {
        // Статус успешного оформления заказа
        //$result = false;

        // Форма отправлена?
        if (isset($_POST['order'])) {
            // Форма отправлена? - Да
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Собираем информацию о заказе
            $productsInCart = Cart::getProductsInCart();
            $userId = false;
            if (!User::isGuest()) {
                $userId = User::isLogged();
            }
            // Сохраняем заказ в БД
            $order = new Order();
            $result = $order->save($userName, $userPhone, $userComment, $userId, $productsInCart);
            if ($result) {
                // Оповещаем администратора о новом заказе
                $adminEmail = 'php.start@ro.ru';
                $message = '/admin/orders';
                $subject = 'Новый заказ!';
                mail($adminEmail, $subject, $message);
                // Очищаем корзину
                Cart::clear();
            }

        } else {
            // Форма отправлена? - Нет
            // Получием данные из корзины
            $productsInCart = Cart::getProductsInCart();

            // В корзине есть товары?
            if ($productsInCart) {
                // В корзине есть товары? - Да
                // Итоги: общая стоимость, количество товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getItemsInList('id', $productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
                // Пользователь авторизирован?
                if (!User::isGuest()) {
                    // Получаем информацию о пользователе из БД по id
                    $userId = User::isLogged();
                    $user = User::getItemById($userId);
                }
            } else {
                // В корзине есть товары? - Нет
                // Отправляем пользователя на главную искать товары
                header("Location: /");
            }
        }
        $this->render('checkout', ['totalQuantity' => $totalQuantity, 'user' => $user[0],
            'totalPrice' => $totalPrice, 'result' => $result]);

    }


}