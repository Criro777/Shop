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

        if ($name != '' && $email != '' && $message != '' && $subject != '') {

            $Body = "Имя: {$name}. Сообщение: {$message}. От {$email}";

            $result = mail($EmailTo, $subject, $Body, "From:" . $email);

            echo "success";

        } else echo "error";
 
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
            // $categoryProducts = Product::getProductsInSearch($search, $page);
            $categoryProducts = Product::getItemsInPage('name', $search, $page);

            $total = Product::Count('name', $search);
            $pagination = new \Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
            $pager = $pagination->get();
        }

        $this->render('search', ['categoryProducts' => $categoryProducts, 'pager' => $pager, 'search' => $search]);


    }

    public function changeMoneyAction()
    {
        $_SESSION['selectMoney'] = $_POST['selectMoney'];

        header("Location: " . $_SERVER['HTTP_REFERER']);


    }


}