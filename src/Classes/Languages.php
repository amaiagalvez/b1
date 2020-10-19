<?php namespace Izt\Basics\Classes;

use Izt\Basics\Classes\Interfaces\ClassInterface;

class Languages implements ClassInterface
{

    const BASQUE = 'eu';
    const SPANISH = 'es';
    const FRENCH = 'fr';
    const ENGLISH = 'en';

    public static function getChoicesArray($empty = false)
    {
        if ($empty) {
            $types[0] = '--';
        }

        $types = [
            self::BASQUE => self::BASQUE,
            self::SPANISH => self::SPANISH,
            self::FRENCH => self::FRENCH,
            self::ENGLISH => self::ENGLISH,
        ];

        return $types;
    }

    public static function getSimpleArray()
    {
        return [self::BASQUE, self::SPANISH, self::FRENCH, self::ENGLISH];
    }

    public static function getName($value)
    {
        $options = self::getChoicesArray(false);

        return array_key_exists($value, $options) ? $options[$value] : '--';
    }
}
