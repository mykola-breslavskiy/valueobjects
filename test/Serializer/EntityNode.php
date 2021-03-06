<?php

use Test\Serializer\EntityNode\Vehicle;
use EventSourced\ValueObject\Reflector\Reflector;

class EntityNode extends \PHPUnit_Framework_TestCase
{
    private $serializer;
    private $deserializer;
    private $car;
    private $bike;

    private $deserialized_car= [
        'id' => '4f8c0cb1-bc3b-4d26-b7dd-4a7210c84d5e',
        'type' => 'car',
        'max_speed' => 150,
        'details' => [
            'wheels'=> 4,
            'seats'=>'leather'
        ]
    ];

    private $deserialized_bike = [
        'id' => '5e8e4208-3014-4df0-842a-f318f533f358',
        'type' => 'bike',
        'max_speed' => 30,
        'details' => [
            'lights'=> 4,
            'saddle'=>'leather'
        ]
    ];

    public function setUp()
    {
        $reflector = new Reflector();
        $this->serializer = new \EventSourced\ValueObject\Serializer\Serializer($reflector);
        $this->deserializer = new \EventSourced\ValueObject\Deserializer\Deserializer($reflector);

        $this->car = $this->deserializer->deserialize(Vehicle::class, $this->deserialized_car);

        $this->bike = $this->deserializer->deserialize(Vehicle::class, $this->deserialized_bike);
    }

    public function test_serialize_car()
    {
        $this->assertEquals($this->deserialized_car, $this->serializer->serialize($this->car));
    }

    public function test_serialize_bike()
    {
        $this->assertEquals($this->deserialized_bike, $this->serializer->serialize($this->bike));
    }

    public function test_fails_if_the_type_does_not_match_the_shape()
    {
        $deserialized_invalid_car = $this->deserialized_car;
        $deserialized_invalid_car['details'] = $this->deserialized_bike['details'];

        $this->setExpectedException(\Exception::class);

        $this->deserializer->deserialize(Vehicle::class, $deserialized_invalid_car);
    }
}