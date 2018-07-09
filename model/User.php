<?php

class User
{
    public $username;
    public $pwd;
    public $idcard;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->username = '';
        $this->pwd = '';
        $this->idcard = '';
    }
//
//    public function __construct($username, $pwd, $idcard)
//    {
//        $this->username = $username;
//        $this->pwd = $pwd;
//        $this->idcard = $idcard;
//    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd): void
    {
        $this->pwd = $pwd;
    }

    /**
     * @return mixed
     */
    public function getIdcard()
    {
        return $this->idcard;
    }

    /**
     * @param mixed $idcard
     */
    public function setIdcard($idcard): void
    {
        $this->idcard = $idcard;
    }

    public function init($arr)
    {
        $this->setUsername($arr[0]);
        $this->setPwd($arr[1]);
        $this->setIdcard($arr[2]);
    }
}
