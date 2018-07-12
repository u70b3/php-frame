<?php

/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/12
 * Time: 15:05
 */
class UserApply
{
    public $id;
    public $MAC;
    public $userid;
    public $isValid;

    /**
     * UserApply constructor.
     * @param $id
     * @param $MAC
     * @param $userid
     */
    public function __construct($MAC, $userid)
    {
        $this->MAC = $MAC;
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getisValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid): void
    {
        $this->isValid = $isValid;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMAC()
    {
        return $this->MAC;
    }

    /**
     * @param mixed $MAC
     */
    public function setMAC($MAC): void
    {
        $this->MAC = $MAC;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid): void
    {
        $this->userid = $userid;
    }
}