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
    }

    public function run()
    {
//        session_start();
        switch ($this->type) {
            case "user-apply":
                $this->apply();
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
            $_POST['mac'],
            $_POST['userid']
        );
        $this->userApplyDao->addUserApply($userApply);
//        redirect("/view/404.html");
    }

    public function ajaxRun()
    {

    }
}


