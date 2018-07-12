<?php

require_once "../utils/include.php";

/**
 * Class UserDAO
 */
class UserDAO
{

    /**
     * @var DBManager
     */
    public $dbManager;

    /**
     * UserDAO constructor.
     */
    public function __construct()
    {
        $this->dbManager = new DBManager();
    }

    //添加用户

    /**
     * @param $user
     */
    public function addUser($user)
    {
        try {

            $this->dbManager->run("insert into user(username,pwd,idcard) values('" . $user->username . "','" . $user->pwd . "'," . $user->idcard . ")");

        } catch (Exception $e) {

//            echo "error:" . $e->getMessage();
        }
    }


    //修改用户

    /**
     * @param $user
     * @param $id
     */
    public function modifyUser($user, $id)
    {

        $this->dbManager->run("update user set username='" . $user->username . "',pwd='" . $user->pwd . "',idcard=" . $user->idcard . " where id=" . $id);

    }

    //删除用户

    /**
     * @param $id
     */
    public function deleteUser($id)
    {
        $this->dbManager->run("delete from  user where id=" . $id);
    }

    /**
     * @param $id
     */
    public function modifyValid($id)
    {
        $this->dbManager->run("update user set isValid=TRUE where id=$id");
    }

    /**
     * @param $company
     * @param $id
     */
    public function modifyCompany($company, $id)
    {
        $this->dbManager->run("update user set company='" . "$company' where id=$id");
    }

    /**
     * @return array
     */
    public function queryUserList()
    {
        $entity = $this->dbManager->entity;
        $rs = $entity->query("select * from user");
        $rs->setFetchMode($entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        return $result_arr;
    }

    /**
     * @param $name
     * @return null
     */
    public function findUserByName($name)
    {
        $result_arr = $this->dbManager->queryOne("select * from user where username='" . "$name'");
        return $result_arr;
    }

    /**
     * @param $id
     * @return null
     */
    public function findUserById($id)
    {
        $result_arr = $this->dbManager->queryOne("select * from user where id=" . $id);
        return $result_arr;
    }

    /**
     * @return array
     */
    public function findUserNotValid()
    {
        $result_arr = $this->dbManager->queryAll("select * from user where identity=1 and isValid=false");
        return $result_arr;
    }

    /**
     *
     */
    public function testQuery()
    {
        $arr = $this->queryUserList();
        foreach ($arr as $value) {
            echo "" . $value['username'] . " " . $value['pwd'] . " " . $value['idcard'] . "\n";
        }
    }

    /**
     *
     */
    public function testAdd()
    {
        $user = new User();
        $user->init(array("lbs", "123456", "411027"));
        $this->addUser($user);
    }

    /**
     *
     */
    public function testModify()
    {
    }

    /**
     *
     */
    public function testDelete()
    {
        $this->deleteUser(3);
    }
}

//$userDao = new UserDAO();
//$userDao->testQuery();
//$userDao->testAdd();
