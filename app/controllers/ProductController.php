<?php

namespace app\controllers;


use app\models\Product;

class ProductController extends AppController
{
    public function viewAction($productId)
    {
        try {
            $product = Product::getItemById($productId);
            $this->render('view', ['product' => $product[0]]);
        }catch (\Exception $e){
            $controller = new ErrorController(['controller' =>'Error', 'action' =>'index']);
            $action = $controller->indexAction();
        }

    }
    
}