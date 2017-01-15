<?php

namespace app\controllers;
use app\models\Category;
use vendor\core\base\AdminBase;
use app\models\Product;


class AdminProductController extends AppController
{
    use AdminBase;
    public $layout = 'admin_panel';
    
    /**
     * Вывод всех товаров на сайте
     * @param $page <p>номер страницы при пагинации</p>
     */
    public function indexAction($page)
    {

        self::checkAdmin();
        if (!isset($page)) {
            $page = 1;
        }
        $productList = Product::getItemsInPage(false, false, $page);
        //$productList = Product::getItemsInPage($page);
        $total = Product::Count();
        $pagination = new \Pagination($total, $page, Product::SHOW_BY_PANEL, 'page-');
        $pager = $pagination->get();
        $this->render('products', ['productList' => $productList, 'pager' => $pager]);

    }

    /**
     * Создание новой карточки товара на сайте
     */

    public function createAction()
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
            header("Location: /admin-product");
        }
        $this->render('create_product', ['categoriesList' => $categoriesList]);

    }

    /**
     * Редактирование текущей карточки товара на сайте
     */

    public function updateAction($id)
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
            header("Location: /admin-product");
        }
        // Подключаем вид
        $this->render('update_product', ['id' => $id, 'categoriesList' => $categoriesList, 'product' => $product[0]]);

    }

    /**
     * Удаление товара по заданному идентификатору
     * @param $id <p> идентификатор товара</p>
     */

    public function deleteAction($id)
    {
        self::checkAdmin();
        $product = new Product();
        $product->deleteItem($id);
        header('Location:/admin-product');

    }


}