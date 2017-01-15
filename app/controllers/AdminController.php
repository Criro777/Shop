<?php

namespace app\controllers;

use app\models\Order;
use app\models\Product;
use vendor\core\base\AdminBase;
use vendor\core\base\Controller;

class AdminController extends Controller
{
    use AdminBase;
    public $layout = 'admin_panel';


    /**
     * Главная страница панели администратора
     */
    public function indexAction()
    {

        if (self::checkAdmin()) {

            $this->render('index');
        }
    }
    

}