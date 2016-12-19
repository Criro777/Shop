<?php


namespace app\models;


use vendor\core\base\Model;
use vendor\core\Db;
use vendor\core\MultiException;

class User extends Model
{
    const TABLE = 'user';
    public $name;
    public $password;
    public $email;

    /**
     * Регистрация нового пользователя
     * @return bool
     */
    public function registerUser()
    {

        $db = Db::instance();

        $sql = 'INSERT INTO user (name, email, password) '
            . 'VALUES (:name, :email, :password)';
        $result = $db->execute($sql, [':name' => $this->name, ':email' => $this->email, ':password' => crypt($this->password, "salt")]);

        return $result;
    }

    /**
     * Обработка и валидация данных пользователя при регистрации
     * @param array $data входящие данные
     * @throws MultiException
     */
    public function fillRegisterData($data)
    {

        $errorsRegister = new MultiException();

        if (strlen($data['name']) <= 2) {
            $errorsRegister->add(new \Exception('Имя не должно быть короче 2-х символов'));
        }
        if (strlen($data['password']) <= 6) {
            $errorsRegister->add(new \Exception('Пароль не должен быть короче 6-ти символов'));
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errorsRegister->add(new \Exception('Неправильный email!'));
        }

        if (User::checkEmailExists($data['email'])) {
            $errorsRegister->add(new \Exception('Такой email уже используется'));
        }


        if (count($errorsRegister) != 0) {
            throw $errorsRegister;
        }
        parent::fillPostData($data);

    }

    /**
     * Обработка и валидация данных пользователя при авторизации
     * @param array $data входящие данные
     * @throws MultiException
     */
    public function fillLogin($data)
    {
        parent::fillPostData($data);

        $user = self::checkUserExists();
        $errorsLogin = new MultiException();

        if (!$user) {
            $errorsLogin->add(new \Exception('Пользователь не найден'));
        }

        if (count($errorsLogin) != 0) {
            throw $errorsLogin;
        }


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
        $user = $db->query($sql, [':email' => $this->email, ':password' => crypt($this->password, "salt")]);
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
        setcookie('idUser', base64_encode($userId), time() + 3600,'/');
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
      

        //header('Location:user/login');
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user']) or isset($_COOKIE['idUser'])) {
            return false;
        }elseif (!isset($_SESSION['user']) && isset($_COOKIE['idUser'])) {
            return false;
        }elseif(!isset($_COOKIE['idUser'])){
        return true;}
    }

}