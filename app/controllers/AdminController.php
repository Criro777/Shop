<?php


namespace app\controllers;


use app\models\Category;
use app\models\Order;
use app\models\Product;
use vendor\core\base\AdminBase;
use vendor\core\base\Controller;

class AdminController extends Controller
{
    use AdminBase;
    public $layout = 'admin_panel';

    public function indexAction()
    {

        if (self::checkAdmin()) {

            $this->render('index');
        }
    }

    public function productAction($page)
    {

        self::checkAdmin();
        if (!isset($page)) {
         $page = 1;
       }
        $productList = Product::getProductsInPage($page);
        //$total = Product::getCountProductsInCategory(21);

        $pagination = new \Pagination(15, $page, Product::SHOW_BY_PANEL, 'page-');
        $pager = $pagination->get();
        $this->render('products', ['productList' => $productList,'pager'=>$pager]);

    }

    public function orderAction()
    {
        // Проверка доступа
        self::checkAdmin();
        // Получаем список заказов
        $ordersList = Order::getListItem();
        // Подключаем вид
        $this->render('orders', ['ordersList' => $ordersList]);

    }

    public function OrderViewAction($id)
    {
        $order = Order::getItemById($id);
        $productsQuantity = json_decode($order[0]->products, true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);
        $this->render('order_view', ['order' => $order[0], 'products' => $products, 'productsQuantity'=> $productsQuantity]);

    }
    
    public function createProductAction()
    {
        self::checkAdmin();
        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getListItem();

        if (isset($_POST['create'])) {

            // Добавляем новый товар
            $newProduct = new Product();
            $newProduct->fillPostData($_POST);
            $id = $newProduct->createItem();
            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/public/images/products/{$id}.jpg");
                }
            };
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product");
        }
        $this->render('create_product', ['categoriesList' => $categoriesList]);

    }

    public function updateProductAction($id)
    {
        $this->layout = 'main';
        // Проверка доступа
        self::checkAdmin();
        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getListItem();
        $updateProduct = new Product();
        // Получаем данные о конкретном заказе
        $product = Product::getItemById($id);
        // Обработка формы
        if (isset($_POST['update'])) {

            // Получаем данные из формы редактирования. При необходимости можно валидировать значения

            // Сохраняем изменения
            $updateProduct->fillPostData($_POST);

            if ($updateProduct->updateItem()) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product");
        }
        // Подключаем вид
        $this->render('update_product', ['id' => $id, 'categoriesList' => $categoriesList,'product' => $product[0]]);

    }

    public function updateOrderAction($id)
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
            header("Location: /admin/order");
        }

        // Подключаем вид
        $this->render('update_order', ['id' => $id, 'order' => $order[0]]);
    }

    public function deleteProductAction($id)
    {
        self::checkAdmin();
        $product = new Product();
        $product->deleteItem($id);
        header('Location:/admin/product');

    }

    public function deleteOrderAction($id)
    {
        self::checkAdmin();
            $order = new Order();
            $order->deleteItem($id);
            header('Location:/admin/order');
        

    }


}