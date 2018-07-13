<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/10
 * Time: 14:32
 */
require_once '../utils/include.php';

/**
 * Class Validate
 */
class Validate
{
    /**
     * @var UserDAO
     */
    public $userdao;

    /**
     * Validate constructor.
     */
    public function __construct()
    {
        $this->userdao = new UserDAO();
    }

    /**
     * @return null
     */
    public function isLogin()
    {
        if (isset($_SESSION['id'])) {
            $user = $this->userdao->findUserById($_SESSION['id']);
            return $user != null;
        } else {
            return false;
        }
    }

    /**
     * @param $user
     * @return bool
     */
    public function addSession($user)
    {
        if (!isset($user['id'])) {
            return false;
        }
        $_SESSION['id'] = $user['id'];
        setcookie("id", $user['id'], time() + 36000, '/');
        return true;
    }

    /**
     * @return bool
     */
    public function removeSession(): bool
    {
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
            return true;
        }
        return false;
    }

}
