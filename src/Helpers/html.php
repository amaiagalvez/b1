<?php

function isUrlActive($routeBase)
{
    if (str_contains(Request::fullUrl(), $routeBase)) {
        return true;
    }

    return false;
}

function isRouteActive($routeBase)
{
    if (str_contains(Route::currentRouteName(), $routeBase)) {
        return true;
    }

    return false;
}

function getPreviousRoute()
{
    return app('router')
        ->getRoutes()
        ->match(app('request')->create(url()->previous()))
        ->getName();
}

function ok_ko_format($value)
{
    if ($value === 1 || $value) {
        return '<i class="fa fa-check ok-color"></i>';
    }

    return '<i class="fa fa-times ko-color"></i>';
}

function ok_format($value)
{
    if ($value === 1 || $value) {
        return '<i class="fa fa-check ok-color"></i>';
    }

    return '';
}

function label($value, $h = "h6")
{
    return '<span class="' . $h . ' badge badge-success"> ' . $value . ' </span>';
}

function email($value, $h = "h6")
{
    return '<a href="mailto:' . $value . '" class="' . $h . ' not-text-decoration"> ' . $value . ' </span>';
}

function getLocalizedJS($folder)
{
    switch (App::getLocale()) {
        case 'es':
            return '<script src="' . asset($folder . '/js/dt_translations_es.js') . '"></script>';
        case 'en':
            return '<script src="' . asset($folder . '/js/dt_translations_en.js') . '"></script>';
        case 'fr':
            return '<script src="' . asset($folder . '/js/dt_translations_fr.js') . '"></script>';
        default:
            return '<script src="' . asset($folder . '/js/dt_translations_eu.js') . '"></script>';
    }
}
