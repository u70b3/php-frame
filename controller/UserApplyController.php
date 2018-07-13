<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/12
 * Time: 15:03
 */
require_once "../utils/include.php";

/**
 * Class UserController
 */
class UserApplyController
{
    public $userApplyDao;
    private $type;
    private $ajax_type;
    private $validate;

    /**
     * UserApplyController constructor.
     * @param $type
     * @param $ajax_type
     */
    public function __construct()
    {
        $this->userApplyDao = new UserApplyDao();
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
        switch ($this->type) {
            case "user-apply":
                $this->apply();
                break;
        }
    }

    public function ajaxRun()
    {
        switch ($this->ajax_type) {
            case "show_user_applys":
                $this->showUserApplys();
                break;
            case "pass_apply":
                $this->passApply();
                break;
            case "delete_apply":
                $this->deleteApply();
                break;
        }
    }
    private function apply()
    {
        $code = $_POST['code'];
        if ($code != $_SESSION['code']) {
            echo "<script>alert('Verification code is not correct.please try again!');history.go(-1);</script>";
            exit();
        }
        $userApply = new UserApply(
            $_POST['MAC'],
            $_POST['userid']
        );
        $this->userApplyDao->addUserApply($userApply);
        redirect("/view/UserHome.html");
    }

    private function showUserApplys()
    {
        $user_applys = $this->userApplyDao->getApplyMsgs();
        $response = new Response(
            200,
            'ok',
            $user_applys
        );
        echo $response->makeResponse();
    }

    private function passApply()
    {
        $response = new Response(
            200,
            '成功',
            null
        );
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userApplyDao->modifyValid($id);
        } else {
            $response->setCode(400);
            $response->setMsg('失败');
        }
        echo $response->makeResponse();
    }

    private function deleteApply()
    {
        $response = new Response(
            200,
            '成功',
            null
        );
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->userApplyDao->deleteUserApply($id);
        } else {
            $response->setCode(400);
            $response->setMsg('失败');
        }
        echo $response->makeResponse();
    }


}


