<?php

require_once "../utils/include.php";

class UserController
{
    public $userdao;
    private $type;
    private $ajax_type;
    public $validate;

    public function __construct()
    {
        $this->userdao = new UserDAO();
        if (isset($_GET['type'])) {
            $this->type = $_GET['type'];
        }
        if (isset($_GET['ajax_type'])) {
            $this->ajax_type = $_GET['ajax_type'];
        }
        $this->validate = new Validate();
    }

    public function run()
    {
        session_start();
        switch ($this->type) {
            case "user-register":
                $this->Register();
                break;
            case "user-login":
                $this->Login();
                break;
            case "user-logout":
                $this->Logout();
                break;
            case "archives-register":
                break;
            case "admin-pass":
                $this->adminPass();
                break;
            case "admin-delete":
                $this->adminDelete();
                break;
        }
    }

    public function ajaxRun()
    {
        switch ($this->ajax_type) {
            case "show_users":
                $this->ShowUsers();
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
        redirect("/index.html");
    }

    public function ShowUsers()
    {
        $users = $this->userdao->findUserNotValid();
        $res['code'] = 200;
        $res['msg'] = 'ok';
        $res['data'] = array();
        foreach ($users as $row) {
            $user['id'] = $row['id'];
            $user['username'] = $row['username'];
            $user['idcard'] = $row['idcard'];
            $user['company'] = $row['company'];
            array_push($res['data'], $user);
        }
        echo json_encode($res);
    }

    public function Login()
    {
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $user = $this->userdao->findUserByName($username);
        if ($user == null) {
            redirect("/index.html");
            return;
        }
        $aupwd = $user['pwd'];
        if ($pwd != $aupwd) {
            redirect("/view/404.html");
            return;
        }
        if ($user['isValid'] == false) {
            redirect("/index.html");
            return;
        }
        if ($user['identity'] == 0) {
            if ($this->validate->addSession($user)) {
                redirect("/view/AdminHome.html");
                return;
            }
            redirect("/view/404.html");
            return;
        }
        if ($user['identity'] == 1) {
            if ($this->validate->addSession($user)) {
                redirect("/view/UserHome.html");
                return;
            }
            redirect("/view/404.html");
            return;
        }
    }

    private function UserLogin()
    {

    }

    private function AdminLogin()
    {

    }

    public function Logout()
    {
        if ($this->validate->removeSession()) {
            redirect("/index.html");
        }
    }

    public function adminPass()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userdao->modifyValid($id);
            redirect("/view/AdminHome.html");
        } else {
            redirect("/index.html");
        }
    }

    public function adminDelete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userdao->deleteUser($id);
            redirect("/view/AdminHome.html");
        } else {
            redirect("/index.html");
        }
    }
}

$userController = new UserController();
$userController->run();
$userController->ajaxRun();
