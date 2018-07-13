<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/13
 * Time: 10:12
 */

$userController = new UserController();
$userApplyController = new UserApplyController();
$userController->run();
$userController->ajaxRun();
$userApplyController->run();
