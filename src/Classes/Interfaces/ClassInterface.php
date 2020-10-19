<?php

namespace Izt\Basics\Classes\Interfaces;

interface ClassInterface
{
    public static function getChoicesArray($empty = false);

    public static function getSimpleArray();

    public static function getName($value);
}
