<?php

interface Type
{}

class SomeType implements Type
{}

class SomeOtherType implements Type
{}

abstract class TypeUser
{
        public function __construct(Type $type)
        {}
        public function doSomething(Type $type)
        {}
}

class SomeTypeUser extends TypeUser
{
        public function __construct(SomeType $type)
        {}
        public function doSomething(SomeType $type)
        {}
}

class SomeOtherTypeUser extends TypeUser
{
        public function __construct(SomeOtherType $type)
        {}
        public function doSomething(SomeOtherType $type)
        {}
}
