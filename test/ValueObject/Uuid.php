<?php

use EventSourced\ValueObject\Assert;
use EventSourced\ValueObject\ValueObject\Uuid;

class TestUuid extends \PHPUnit_Framework_TestCase 
{
    public function test_valid_value()
    {
        new Uuid("ac9e4e83-5495-4a58-90d9-eeeaf3989bc8");
    }
    
    public function test_invalid_value()
    {
        $this->setExpectedException(Assert\IsException::class);
        new Uuid("asdfasdf");
    }
}