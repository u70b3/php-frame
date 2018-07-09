<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/9
 * Time: 14:20
 */
require_once "../Config.php";

class DBManager
{
    /**
     * DBManager constructor.
     */
    public $config;
    public $entity;
    private $sql;

    public function __construct()
    {
        $this->config = new Config();
        $this->entity = new PDO(
            $this->config::dsn,
            $this->config::db_user,
            $this->config::db_pwd,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
            )
        );
    }

    public function run($sql)
    {
        $this->setSql($sql);
        $this->entity->exec($this->sql);
    }

    /**
     * @param mixed $sql
     */
    private function setSql($sql): void
    {
        $this->sql = $sql;
    }

    public function queryOne($sql)
    {
        $rs = $this->entity->query($sql);
        $rs->setFetchMode($this->entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        return $result_arr[0];
    }

    public function queryAll($sql)
    {
        $rs = $this->entity->query($sql);
        $rs->setFetchMode($this->entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        return $result_arr;
    }

    public function queryLimit($sql, $start, $end)
    {

    }

}

$dbManager = new DBManager();
