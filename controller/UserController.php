<?php

require_once "../DAO/UserDao.php";
require_once "../model/User.php";

class UserController
{
    public $userdao;
    private $type;

    public function __construct()
    {
        $this->userdao = new UserDAO();
        $this->type = $_GET['type'];
    }

    public function run()
    {
        var_dump($this->type);
        switch ($this->type) {
            case "user-register":
                $this->Register();
                break;
            case "user-login":
                $this->Login();
                break;
            case "archives-register":
                break;
        }
    }

    public function Register()
    {
        $user = new User();
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $idcard = $_POST['idcard'];
        $data = array($username, $pwd, $idcard);
        $user->init($data);
        $this->userdao->addUser($user);
        header("Location: /index.php");
    }

    public function Login()
    {
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $aupwd = $this->userdao->findUserByName($username)['pwd'];
        if ($pwd == $aupwd) {
            echo "success";
        }
    }
}

$userController = new UserController();
$userController->run();
