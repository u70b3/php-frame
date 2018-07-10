<?php
/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/9
 * Time: 14:20
 */
require_once "../utils/include.php";

class DBManager
{
    /**
     * DBManager constructor.
     */
    public $config;
    /**
     * @var PDO
     */
    public $entity;
    /**
     * @var
     */
    private $sql;

    /**
     * DBManager constructor.
     */
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


    /**
     * @param $sql
     */
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

    /**
     * @param $sql
     * @return null
     */
    public function queryOne($sql)
    {
        $rs = $this->entity->query($sql);
        $rs->setFetchMode($this->entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        if (!empty($result_arr)) {
            return $result_arr[0];
        } else {
            return null;
        }
    }

    /**
     * @param $sql
     * @return array
     */
    public function queryAll($sql)
    {
        $rs = $this->entity->query($sql);
        $rs->setFetchMode($this->entity::FETCH_ASSOC);
        $result_arr = $rs->fetchAll();
        return $result_arr;
    }

    /**
     * @param $sql
     * @param $start
     * @param $end
     */
    public function queryLimit($sql, $start, $end)
    {

    }

}

//$dbManager = new DBManager();
