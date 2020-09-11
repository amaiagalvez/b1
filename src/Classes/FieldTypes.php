<?php namespace Izt\Users\Classes;

use Izt\Helpers\Classes\Interfaces\ClassInterface;

class FieldTypes implements ClassInterface
{

    const TEXT = 'text';
    const NUMBER = 'number';
    const LONGTEXT = 'longtext';
    const BOOLEAN = 'boolean';
    const IMAGE = 'image';
    const LIST = 'list';

    public static function getChoicesArray($empty = false)
    {
        if ($empty) {
            $types[0] = '--';
        }

        $types = [
            self::TEXT => 'text',
            self::NUMBER => 'number',
            self::LONGTEXT => 'longtext',
            self::BOOLEAN => 'boolean',
            self::IMAGE => 'image',
            self::LIST => 'list',
        ];

        return $types;
    }

    public static function getSimpleArray()
    {
        return [self::TEXT, self::NUMBER, self::LONGTEXT, self::BOOLEAN, self::IMAGE, self::LIST];
    }

    public static function getName($value)
    {
        $options = self::getChoicesArray(false);

        return array_key_exists($value, $options) ? $options[$value] : '--';
    }
}
