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
        $latestProducts = Product::getCountItems(6);

        $this->render('index', ['latestProducts' => $latestProducts]);

    }
    

}