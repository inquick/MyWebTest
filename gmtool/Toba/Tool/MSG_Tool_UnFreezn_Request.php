<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: TSProtocol.proto

namespace Toba\Tool;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>toba.tool.MSG_Tool_UnFreezn_Request</code>
 */
class MSG_Tool_UnFreezn_Request extends \Google\Protobuf\Internal\Message
{
    /**
     *账号id		
     *
     * Generated from protobuf field <code>uint32 account_id = 1;</code>
     */
    private $account_id = 0;

    public function __construct() {
        \GPBMetadata\TSProtocol::initOnce();
        parent::__construct();
    }

    /**
     *账号id		
     *
     * Generated from protobuf field <code>uint32 account_id = 1;</code>
     * @return int
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     *账号id		
     *
     * Generated from protobuf field <code>uint32 account_id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setAccountId($var)
    {
        GPBUtil::checkUint32($var);
        $this->account_id = $var;

        return $this;
    }

}
