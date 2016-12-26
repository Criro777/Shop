<?php

namespace app\controllers;
use vendor\core\base\AdminBase;
use app\models\Blog;


class AdminBlogController extends AppController
{
    use AdminBase;
    public $layout = 'admin_panel';
    /**
     * Вывод всех записей в блоге
     * @param $page <p>номер страницы при пагинации</p>
     */

    public function indexAction($page)
    {

        self::checkAdmin();
        if (!isset($page)) {
            $page = 1;
        }
        $blogList = Blog::getItemsInPage(false, false, $page);
        //$productList = Product::getItemsInPage($page);
        $total = Blog::Count();
        $pagination = new \Pagination($total, $page, Blog::SHOW_BY_PANEL, 'page-');
        $pager = $pagination->get();
        $this->render('blog', ['blogList' => $blogList, 'pager' => $pager]);

    }

    public function createAction()
    {

        // Получаем список категорий для выпадающего списка

        if (isset($_POST['create'])) {

            // Добавляем новый товар
            $newBlog = new Blog();
            $newBlog->fillPostData($_POST);
            $id = $newBlog->createItem();
            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/public/images/blog/{$id}.jpg");
                }
            };
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin-blog");
        }
        $this->render('create_blog');

    }

    public function updateAction($id)
    {
        $this->layout = 'main';
        
        $updateBlog = new Blog();
        // Получаем данные о конкретном заказе
        $blog= Blog::getItemById($id);
        // Обработка формы
        if (isset($_POST['update'])) {

            // Получаем данные из формы редактирования. При необходимости можно валидировать значения

            // Сохраняем изменения
            $updateBlog->fillPostData($_POST);

            if ($updateBlog->updateItem()) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/blog/{$id}.jpg");
                }
            }
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin-blog");
        }
        // Подключаем вид
        $this->render('update_blog', ['id' => $id, 'blog' => $blog[0]]);

    }

    public function deleteAction($id)
    {
        
        $blog = new Blog();
        $blog->deleteItem($id);
        header('Location:/admin-blog');

    }


}