<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/13
 * Time: 10:12
 */
require_once "../utils/include.php";

class RouteController
{
    public $validate;
    public $userController;
    public $userApplyController;

    /**
     * RouteController constructor.
     */
    public function __construct()
    {
        $this->validate = new Validate();
        $this->userController = new UserController();
        $this->userApplyController = new UserApplyController();
    }

    public function run()
    {
        session_start();
        $this->userController->run();
        $this->userApplyController->run();
        if (!$this->validate->isLogin()) {
            return;
        }
        $this->userController->ajaxRun();
        $this->userApplyController->ajaxRun();
    }
}

$routeController = new RouteController();
$routeController->run();
//if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
//    main();
//}
