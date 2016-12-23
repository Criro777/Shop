<?php

namespace app\controllers;

use app\models\Product;

/**
 * Контроллер SiteController
 */
class SiteController extends AppController
{

    public function indexAction()
    {
        $latestProducts = Product::getListItem();

        $this->render('index', ['latestProducts' => $latestProducts]);

    }

    public function messageAction()
    {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $subject = $_POST["subject"];
        $EmailTo = 'php.start@mail.ru';

        $Body = "Имя: {$name}. Сообщение: {$message}. От {$email}";
        $result = mail($EmailTo, $subject, $Body, "From:" . $email);
        if ($result) {
            echo "success";
        }

    }

    public function contactAction()
    {

        $this->render('contact');

    }

    public function searchAction($page)
    {

        if (!isset($_POST['search_query'])) {
            $_POST['search_query'] = $_SESSION['search'];
        }

        if (!isset($page)) {
            $page = 1;
        }

        if (!empty($_POST['search_query'])) {
            $search = $_POST['search_query'];
            $_SESSION['search'] = $search;
            $categoryProducts = Product::getProductsInSearch($search, $page);
            $total = Product::getCountProductsInSearch($search);
            $pagination = new \Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
            $pager = $pagination->get();
        }

        $this->render('search', ['categoryProducts' => $categoryProducts, 'pager' => $pager, 'search' => $search]);


    }


}