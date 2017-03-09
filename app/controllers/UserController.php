<?php

namespace app\controllers;


use app\models\User;
use vendor\core\MultiException;

class UserController extends AppController
{
    public function registerAction()
    {

        if (!isset($_SESSION['user'])) {

            $this->render('register');

            unset($_SESSION['errors']);

            if (isset($_POST['register'])) {


                $user = new User();
                $validation = $user->RegValidateData($_POST);


                if (count($validation) != 0) {

                    $_SESSION['errors'] = $validation;
                    header('Location:/user/register');

                } else {
                    $success = $user->registerUser();
                    $_SESSION['success'] = $success;
                    header('Location:/user/login');

                }


            }
        } else {
            header('Location:/profile');

        }
    }

    public function loginAction()
    {
        if (!isset($_SESSION['user'])) {

            $this->render('login');
            unset($_SESSION['errors']);
            unset($_SESSION['success']);

            if (isset($_POST['login'])) {

                $user = new User();
                $auth = $user->LogValidateData($_POST);

                if (count($auth) != 0) {

                    $_SESSION['errors'] = $auth;

                }
                $currentUser = $user->checkUserExists();

                User::authUser($currentUser[0]->id);

                if (isset($_POST['remember'])) {

                    User::rememberUser($currentUser[0]->id);

                }
                header("Location:/profile");
                

            }

            //header('Location:/user/login');

        } else header('Location:/profile');

    }

    public function logoutAction()
    {
        session_start();

        unset($_SESSION['user']);

        if (isset($_COOKIE['idUser'])) {

            setcookie('idUser', '', time() - 3600, '/');

        }
        header("Location: /");
    }

}