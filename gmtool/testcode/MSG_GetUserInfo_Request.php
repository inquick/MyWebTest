<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: simple.proto

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * 查找玩家基本信息
 *
 * Generated from protobuf message <code>MSG_GetUserInfo_Request</code>
 */
class MSG_GetUserInfo_Request extends \Google\Protobuf\Internal\Message
{
    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 1;</code>
     */
    private $uid = 0;

    public function __construct() {
        \GPBMetadata\Simple::initOnce();
        parent::__construct();
    }

    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 1;</code>
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 玩家ID
     *
     * Generated from protobuf field <code>uint32 uid = 1;</code>
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

