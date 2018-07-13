<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/13
 * Time: 10:12
 */
require_once "../utils/include.php";

function main()
{
    session_start();
    $userController = new UserController();
    $userApplyController = new UserApplyController();
    $userController->run();
    $userController->ajaxRun();
    $userApplyController->run();
    $userApplyController->ajaxRun();
}

if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    main();
}
