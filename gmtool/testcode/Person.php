<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: simple.proto

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Person</code>
 */
class Person extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes name = 1;</code>
     */
    private $name = '';

    public function __construct() {
        \GPBMetadata\Simple::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>bytes name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>bytes name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, False);
        $this->name = $var;

        return $this;
    }

}

