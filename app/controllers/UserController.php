<?php

namespace app\controllers;


use app\models\User;
use vendor\core\MultiException;

class UserController extends AppController
{
    public function registerAction()
    {
        if(!isset($_SESSION['user'])) {

            if (isset($_POST['register'])) {

                try {

                    $user = new User();
                    $user->fillRegisterData($_POST);
                    $success = $user->registerUser();

                } catch (MultiException $errorsRegister) {

                }
            }
            $this->render('register', ['success' => $success, 'errors' => $errorsRegister]);
        }else header('Location:/profile');

    }

    public function loginAction()
    {
        if(!isset($_SESSION['user'])) {
        if (isset($_POST['login'])) {

            try {

                $user = new User();
                $user->fillLogin($_POST);
                $currentUser = $user->checkUserExists();
                User::authUser($currentUser[0]->id);
                if (isset($_POST['remember'])) {
                    User::rememberUser($currentUser[0]->id);

                }
                header("Location:/profile");
            } catch (MultiException $errorsLogin) {

                // echo $errorsLogin->getMessage();
            }
        }
        $this->render('login', ['errors1' => $errorsLogin]);
    } else header('Location:/profile');

    }

    public function logoutAction()
    {
        session_start();
        unset($_SESSION['user']);

        if (isset($_COOKIE['idUser'])) {

            setcookie('idUser', '', time() - 3600,'/');

        }
        header("Location: /");
    }

}