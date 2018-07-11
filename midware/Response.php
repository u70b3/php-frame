<?php

/**
 * Created by IntelliJ IDEA.
 * User: kid_1412
 * Date: 2018/7/11
 * Time: 11:30
 */
class Response
{
    public $code;
    public $msg;
    public $data;

    /**
     * Response constructor.
     * @param $code
     * @param $msg
     * @param $data
     */
    public function __construct($code, $msg, $data)
    {
        $this->code = $code;
        $this->msg = $msg;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function makeResponse()
    {
        $res['code'] = $this->code;
        $res['msg'] = $this->msg;
        $res['data'] = array();
        if ($this->data == null) {
            return json_encode($res);
        }
        foreach ($this->data as $row) {
            $t = array();
            foreach ($row as $k => $v) {
                $t[$k] = $v;
            }
            array_push($res['data'], $t);
        }
        return json_encode($res);
    }
}
