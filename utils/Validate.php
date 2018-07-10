<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/10
 * Time: 14:32
 */
require_once '../utils/include.php';

class Validate
{
    public $userdao;

    /**
     * Validate constructor.
     */
    public function __construct()
    {
        $this->userdao = new UserDAO();
    }

    public function isLogin()
    {
        session_start();
        $id = $_SESSION['id'];
        $user = $this->userdao->findUserById($id);
        return $user;
    }

    public function addSession($user)
    {
        if (!isset($user['id'])) {
            return false;
        }
        session_start();
        $_SESSION['id'] = $user['id'];
        return true;
    }

    public function removeSession(): bool
    {
        if (isset($_SESSION['id'])) {
            unset($_SESSION['id']);
            return true;
        }
        return false;
    }
}