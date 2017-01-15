<?php

namespace app\controllers;

use app\models\Order;
use app\models\Product;
use vendor\core\base\AdminBase;
use vendor\core\base\Controller;


class AdminOrderController extends AppController
{
    use AdminBase;
    public $layout = 'admin_panel';


    /**
     * Вывод всех заказов
     * @param $page <p>номер страницы при пагинации</p>
     */

    public function indexAction()
    {
        // Проверка доступа
        self::checkAdmin();
        // Получаем список заказов
        $ordersList = Order::getListItem();
        // Подключаем вид
        $this->render('orders', ['ordersList' => $ordersList]);

    }

    /**
     * Просмотр заказа
     * @param $id <p>идентификатор заказа</p>
     */

    public function viewAction($id)
    {
        $order = Order::getItemById($id);
        $productsQuantity = json_decode($order[0]->products, true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getItemsInList('id', $productsIds);
        $this->render('order_view', ['order' => $order[0], 'products' => $products, 'productsQuantity' => $productsQuantity]);

    }

    /**
     * Редактирование заказа
     * @param $id <p>идентификатор заказа</p>
     */
    public function updateAction($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $updateOrder = new Order();
        $order = Order::getItemById($id);

        // Обработка формы
        if (isset($_POST['order'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $updateOrder->fillPostData($_POST);

            // Сохраняем изменения
            //Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Перенаправляем пользователя на страницу управлениями заказами
            header("Location: /admin-order");
        }

        // Подключаем вид
        $this->render('update_order', ['id' => $id, 'order' => $order[0]]);
    }

    /**
     * Удаление заказа
     * @param $id <p>идентификатор заказа</p>
     */
    public function deleteAction($id)
    {
        self::checkAdmin();
        $order = new Order();
        $order->deleteItem($id);
        header('Location:/admin-order');


    }

}