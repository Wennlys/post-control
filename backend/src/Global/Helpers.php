<?php

function dismount_obj($object)
{
    $reflectionClass = new ReflectionClass(get_class($object));
    $array = [];
    foreach ($reflectionClass->getProperties() as $property) {
        $property->setAccessible(true);
        $array[$property->getName()] = $property->getValue($object);
        $property->setAccessible(false);
    }

    return $array;
}
