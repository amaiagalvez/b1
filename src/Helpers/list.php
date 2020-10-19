<?php

function getArray($value)
{
    return explode(',', str_replace(['[', ']', '"', ' '], '', $value));
}

function getList($value)
{
    return implode(', ', json_decode($value));
}
