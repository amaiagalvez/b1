<?php

function getDataTime($value)
{
    if (!empty($value)) {
        return date('Y-m-d H:i:s', strtotime($value));
    }
    return '';
}

function getDataHumans($value)
{
    if (!empty($value)) {
        return $value->diffForHumans();
    }
    return '';
}

function getDataDiff($data1, $data2)
{
    if (empty($data2) || ($data2 < $data1)) {
        return '';
    }

    $total_seconds = strtotime($data2) - strtotime($data1);

    $horas = floor($total_seconds / 3600);
    $minutes = (($total_seconds / 60) % 60);
    $seconds = ($total_seconds % 60);

    $time['horas'] = str_pad($horas, 2, '0', STR_PAD_LEFT);
    $time['minutes'] = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    $time['seconds'] = str_pad($seconds, 2, '0', STR_PAD_LEFT);

    $time = implode(':', $time);

    return $time;
}
