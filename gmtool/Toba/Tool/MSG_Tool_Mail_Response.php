<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: TSProtocol.proto

namespace Toba\Tool;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>toba.tool.MSG_Tool_Mail_Response</code>
 */
class MSG_Tool_Mail_Response extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>uint32 returncode = 1;</code>
     */
    private $returncode = 0;

    public function __construct() {
        \GPBMetadata\TSProtocol::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>uint32 returncode = 1;</code>
     * @return int
     */
    public function getReturncode()
    {
        return $this->returncode;
    }

    /**
     * Generated from protobuf field <code>uint32 returncode = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setReturncode($var)
    {
        GPBUtil::checkUint32($var);
        $this->returncode = $var;

        return $this;
    }

}
