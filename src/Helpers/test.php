<?php

function fCreate($class, $attributes = [], $times = null, $withOutObservers = false)
{
    if ($withOutObservers) {

        $class::flushEventListeners();
    }

    return factory($class, $times)->create($attributes);
}


function fMake($class, $attributes = [], $times = null, $withOutObservers = false)
{
    if ($withOutObservers) {

        $class::flushEventListeners();
    }

    return factory($class, $times)->make($attributes);
}

function testEnviroment($app)
{
    $app['config']->set('database.default', 'testing');
    $app['config']->set('database.connection.testing', [
        'driver' => 'sqlite',
        'database' => ':memory:'
    ]);
}
