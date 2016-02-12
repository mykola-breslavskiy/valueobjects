<?php

namespace EventSourced\ValueObject;

use EventSourced\Contract;
use EventSourced\Assert\Assert;

abstract class AbstractValueObject implements Contract\ValueObject
{	    
    public function equals($valueobject) 
	{
		return (get_class($this) == get_class($valueobject));
	}
    
    protected function assert()
    {
        return new Assert(get_called_class());
    }
}