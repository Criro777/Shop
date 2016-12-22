<?php
/**
 * Created by PhpStorm.
 * User: Guliano
 * Date: 20.12.2016
 * Time: 23:09
 */

namespace vendor\core\base;


use app\models\User;

trait AdminBase
{

    public static function checkAdmin()
    {
        $userId = User::isLogged();
        $user = User::getItemById($userId);
        if ($user[0]->role == 'admin') {
            return true;
        }
        return false;
    }

}