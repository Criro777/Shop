<?php

namespace app\controllers;


use app\models\Category;
use app\models\Product;

class CategoryController extends AppController
{
    public function indexAction($category_id, $page)
    {

        if (!isset($page)) {
            $page = 1;
        }
        try {
            $categoryProducts = Product::getProductsInCategory($category_id, $page);
            $currentCategory = Category::getItemById($category_id);
            $total = Product::getCountProductsInCategory($category_id);

            $pagination = new \Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page');
            $pager = $pagination->get();
            $this->render('index', ['categoryProducts' => $categoryProducts, 'currentCategory' => $currentCategory[0], 'pager' => $pager]);
        } catch (\Exception $e) {
            $controller = new ErrorController(['controller' => 'Error', 'action' => 'index']);
            $action = $controller->indexAction();
        }
    }

}