<?php

class User
{
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $pwd;
    /**
     * @var string
     */
    public $idcard;
    /**
     * @var int
     */
    public $isValid;
    /**
     * @var int
     */
    public $identity;
    public $company;

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->username = '';
        $this->pwd = '';
        $this->idcard = '';
        $this->identity = 1;
        $this->isValid = 0;
        $this->company = '';
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

    /**
     * @param $arr
     */
    public function init($arr)
    {
        $this->setUsername($arr[0]);
        $this->setPwd($arr[1]);
        $this->setIdcard($arr[2]);
    }

    /**
     * @return int
     */
    public function getisValid(): int
    {
        return $this->isValid;
    }

    /**
     * @param int $isValid
     */
    public function setIsValid(int $isValid): void
    {
        $this->isValid = $isValid;
    }

    /**
     * @return int
     */
    public function getIdentity(): int
    {
        return $this->identity;
    }

    /**
     * @param int $identity
     */
    public function setIdentity(int $identity): void
    {
        $this->identity = $identity;
    }
}
