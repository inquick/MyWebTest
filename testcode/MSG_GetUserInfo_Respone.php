<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: simple.proto

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>MSG_GetUserInfo_Respone</code>
 */
class MSG_GetUserInfo_Respone extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.ERRNO result = 1;</code>
     */
    private $result = 0;
    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 2;</code>
     */
    private $uid = 0;

    public function __construct() {
        \GPBMetadata\Simple::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.ERRNO result = 1;</code>
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Generated from protobuf field <code>.ERRNO result = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setResult($var)
    {
        GPBUtil::checkEnum($var, \ERRNO::class);
        $this->result = $var;

        return $this;
    }

    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 2;</code>
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setUid($var)
    {
        GPBUtil::checkUint32($var);
        $this->uid = $var;

        return $this;
    }

}

