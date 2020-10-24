<?php namespace Izt\Basics\Classes;

use Izt\Basics\Classes\Interfaces\ClassInterface;

class Genders implements ClassInterface
{

    const FEMALE = 1;
    const MALE = 2;
    const NON_BINARY = 3;

    public static function getChoicesArray($empty = false)
    {
        if ($empty) {
            $types[0] = '--';
        }

        $types = [
            self::FEMALE => trans('basics::basics.female'),
            self::MALE => trans('basics::basics.male'),
            self::NON_BINARY => trans('basics::basics.non-binary'),
        ];

        return $types;
    }

    public static function getSimpleArray()
    {
        return [self::FEMALE, self::MALE, self::NON_BINARY];
    }

    public static function getName($value)
    {
        $options = self::getChoicesArray(false);

        return array_key_exists($value, $options) ? $options[$value] : '--';
    }
}
