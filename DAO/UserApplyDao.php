<?php

/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/12
 * Time: 15:06
 */
require_once "../utils/include.php";

class UserApplyDao
{
    public $dbManager;

    /**
     * UserApplyDao constructor.
     * @param $dbManager
     */
    public function __construct()
    {
        $this->dbManager = new DBManager();
    }

    public function findById($id)
    {
        $result_arr = $this->dbManager->queryOne("select * from user_apply where id=" . $id);
        return $result_arr;
    }

    public function findByMAC($MAC)
    {
        $result_arr = $this->dbManager->queryOne("select * from user_apply where mac='" . "$MAC'");
        return $result_arr;
    }

    public function selectAll()
    {
        $result_arr = $this->dbManager->queryAll("select * from user_apply");
        return $result_arr;
    }

    public function addUserApply($user_apply)
    {
        try {
            $this->dbManager->run(
                "insert into user_apply(mac,userid) values('" . $user_apply->MAC . "'," . $user_apply->userid . ")"
            );

        } catch (Exception $e) {

        }
    }

    public function modifyValid($id)
    {
        try {

            $this->dbManager->run(
                "update user_apply set isValid=true where id=$id"
            );

        } catch (Exception $e) {

        }
    }

    public function getApplyMsgs()
    {
        $res = $this->dbManager->queryAll(
            "select ua.userid as uid, ua.id as id,u.idcard as idcard,u.username as username,ua.mac as MAC, u.company as company from user_apply as ua inner join user as u on u.id = ua.userid where ua.isValid=false and ua.isDeleted = false"
        );
        return $res;
    }

    public function deleteUserApply($id)
    {
        $this->dbManager->run("update user_apply set isDeleted = true where id= " . $id);
    }

}
