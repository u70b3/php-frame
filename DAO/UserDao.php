<?php

require_once "../interface/DBManager.php";
require_once "../DAO/UserDao.php";
require_once "../model/User.php";

class UserDAO
{

    public $dbManager;

    public function __construct()
    {
        $this->dbManager = new DBManager();
    }

    //添加用户
    public function addUser($user)
    {
        try {

            $this->dbManager->run("insert into user(username,pwd,idcard) values('" . $user->username . "','" . $user->pwd . "'," . $user->idcard . ")");

        } catch (Exception $e) {

            echo "error:" . $e->getMessage();
        }
    }

    //修改用户
    public function modifyUser($user, $id)
    {

        $this->dbManager->run("update user set username='" . $user->username . "',pwd='" . $user->pwd . "',idcard=" . $user->idcard . " where id=" . $id);

    }

    //删除用户
    public function deleteUser($id)
    {
        $this->dbManager->run("delete from  user where id=" . $id);
    }

    //查询所有用户
    public function queryUserList()
    {
        $entity = $this->dbManager->entity;
        $rs = $entity->query("select * from user");
        $rs->setFetchMode($entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        return $result_arr;
    }

    public function findUserByName($name)
    {
        $result_arr = $this->dbManager->queryOne("select * from user where username='" . "$name'");
        return $result_arr;
    }

}

$userDao = new UserDAO();

// $arr = $user->queryUserList();
// foreach ($arr as $value) {
//     echo "".$value['username']. " " . $value['pwd'] . " " . $value['idcard'] . "\n";
// }


//$user = new User();
//$user->init(array("lbs", "123456", "411027"));
//$userDao->addUser($user);
//echo "添加成功\n";

//$userModify=array("liudehua","gggggg",40,2,);
//$user->modifyUser($userModify);
//echo "修改成功！";

/*
用户删除

$user->deleteUser(3);
echo "删除成功！";
 */
