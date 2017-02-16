<?php


namespace app\models;


use vendor\core\base\Model;
use vendor\core\Db;
use vendor\core\MultiException;

class User extends Model
{
    const TABLE = 'user';


    /**
     * Регистрация нового пользователя
     * @return bool
     */
    public function registerUser()
    {

        $db = Db::instance();
        //$today = date("g:i a");

        $sql = 'INSERT INTO ' . static::TABLE . '( name, email, password, time) '
            . ' VALUES (:name, :email, :password, :time)';
        $result = $db->execute($sql, [':name' => $this->data['name'], ':email' => $this->data['email'],
            ':password' => crypt($this->data['password'], "salt"),
            ':time' => date("g:i a")]);

        //$result = $db->execute($sql, [':name' => $this->name,
           // ':email' => $this->email, ':password' => crypt($this->password, "salt"),':time' => date("g:i a")]);

        return $result;
    }

    /**
     * Обработка и валидация данных пользователя при регистрации
     * @param array $data входящие данные
     * @throws MultiException
     */
    public function RegValidateData($data)
    {

        parent::fillPostData($data);


        $errorsRegister = [];


        if (strlen($data['name']) <= 2 or $data['name'] = '') {

            $errorsRegister[] = 'Имя не должно быть короче 2-х символов';
        }
        if (strlen($data['password']) <= 6 or $password = '') {

            $errorsRegister[] = 'Пароль не должен быть короче 6-ти символов';
        }

        if (User::checkEmailExists($data['email'])) {

            $errorsRegister[] = 'Такой email уже используется';
        }

        return $errorsRegister;
    }

    /**
     * Обработка и валидация данных пользователя при авторизации
     * @param array $data входящие данные
     * @throws MultiException
     */
    public function LogValidateData($data)
    {
        parent::fillPostData($data);

        if ($data['email'] = '') {
            $errorsLogin[] = 'Введите корректный email';
        }

        $user = self::checkUserExists();
        $errorsLogin = [];

        if (!$user) {
            $errorsLogin[] = 'Пользователь не найден';
        }

        return $errorsLogin;

    }

    /**
     * Проверка введенного email на наличие такового в БД
     * @param string $email введенный адрес
     * @return bool
     */

    public static function checkEmailExists($email)
    {

        $db = Db::instance();

        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE email = :email';

        $result = $db->query($sql, [':email' => $email]);
        if ($result) {

            return true;
        }
        return false;
    }

    /**
     * Авторизация пользователя
     * @return bool
     */
    public function checkUserExists()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $user = $db->query($sql, [':email' => $this->data['email'], ':password' => crypt($this->data['password'], "salt")]);

        if ($user) {

            return $user;
        }
        return false;
    }

    /**
     * Запись id пользователя в сессию
     * @param string $userId
     */
    public static function authUser($userId)
    {

        $_SESSION['user'] = $userId;
    }

    /**
     * Запись id пользователя в куки
     * @param string $userId
     */

    public static function rememberUser($userId)
    {
        setcookie('idUser', base64_encode($userId), time() + 60, '/');
    }

    /**
     * Проверка авторизации пользователя
     * @return string id идентификатор пользователя
     */
    public static function isLogged()
    {

        // Если сессия есть, вернем идентификатор пользователя


        if (isset($_SESSION['user'])) {

            return $_SESSION['user'];
        }


        header('Location:user/login');
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user']) or isset($_COOKIE['idUser'])) {
            return false;
        } elseif (!isset($_SESSION['user']) && isset($_COOKIE['idUser'])) {
            return false;
        } elseif (!isset($_COOKIE['idUser'])) {
            return true;
        }
    }

}