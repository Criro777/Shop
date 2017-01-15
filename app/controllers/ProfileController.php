<?php


namespace app\controllers;


use app\models\User;

class ProfileController extends AppController
{
    public function indexAction()
    {
        

        if ($userId = User::isLogged()) {

            $user = User::getItemById($userId);
            
            $this->render('index', ['user' => $user[0]]);

        } else {

            header("Location: /user/login");
        }
    }


}