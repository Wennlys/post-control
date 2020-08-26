<?php

declare(strict_types=1);

function dismount_obj($object): array
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

function now(): string
{
    $date = new DateTime('now', new DateTimeZone('UTC'));

    return $date->format('Y-m-d\TH:i:sT');
}
