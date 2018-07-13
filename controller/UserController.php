<?php

require_once "../utils/include.php";

/**
 * Class UserController
 */
class UserController
{
    /**
     * @var UserDAO
     */
    public $userdao;
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $ajax_type;
    /**
     * @var Validate
     */
    public $validate;

    /**
     * UserController constructor.
     */
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

    /**
     *
     */
    public function run()
    {
        switch ($this->type) {
            case "user-register":
                $this->Register();
                break;
            case "user-login":
                $this->Login();
                break;
            case "check_username":
                $this->apiCheckLogin();
                break;
        }
    }
    /**
     *
     */
    public function ajaxRun()
    {
        switch ($this->ajax_type) {
            case "show_users":
                $this->ShowUsers();
                break;

            case "pass_user":
                $this->passUser();
                break;
            case "delete_user":
                $this->deleteUser();
                break;
            case "user_logout":
                $this->Logout();
                break;
        }
    }

    /**
     *
     */
    private function Register()
    {
        $code = $_POST['code'];
        if ($code != $_SESSION['code']) {
            echo "
                <script>alert('Verification code is not correct.please try again!');
                history.go(-1);
                </script>";
            exit();
        }
        $user = new User();
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd = $this->salted_password($pwd);
        $idcard = $_POST['idcard'];
        $data = array($username, $pwd, $idcard);
        $user->init($data);
        $this->userdao->addUser($user);
        redirect("/index.html");
    }

    /**
     * @param $pwd
     * @return string
     */
    private function sha_password($pwd)
    {
        return hash('SHA256', $pwd);
    }

    /**
     * @param $pwd
     * @param string $salt
     * @return string
     */
    private function salted_password($pwd, $salt = '$!@><?>HUI&DWQa`')
    {
        $sha1 = $this->sha_password($pwd);
        $sha2 = $this->sha_password($sha1 . $salt);
        return $sha2;
    }

    /**
     *
     */
    private function ShowUsers()
    {
        $users = $this->userdao->findUserNotValid();
        $response = new Response(
            200,
            'ok',
            $users
        );
        echo $response->makeResponse();
    }

    /**
     *
     */
    private function apiCheckLogin()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $user = $this->userdao->findUserByName($username);
            $response = new Response(
                200,
                '可以使用',
                null
            );
            if ($user != null) {
                $response->setCode(400);
                $response->setMsg('用户名已经被注册');
            }
            echo $response->makeResponse();
        }
    }

    /**
     *
     */
    private function Login()
    {
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd = $this->salted_password($pwd);
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

    private function Logout()
    {
        $response = new Response(
            200,
            '登出成功',
            null);
        if ($this->validate->removeSession()) {
            //pass

        } else {
            $response->code = 400;
            $response->msg = '你还没登陆呢就想着登出';
            $response->msg = $_SESSION;
        }
        $res = $response->makeResponse();
        echo $res;
    }

    /**
     *
     */
    public function passUser()
    {
        $response = new Response(
            200,
            '成功',
            null
        );
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userdao->modifyValid($id);
        } else {
            $response->setCode(400);
            $response->setMsg('失败');
        }
        echo $response->makeResponse();
    }

    private function deleteUser()
    {
        $response = new Response(
            200,
            '成功',
            null
        );
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userdao->deleteUser($id);
        } else {
            $response->setCode(400);
            $response->setMsg('失败');
        }
        echo $response->makeResponse();
    }
}
