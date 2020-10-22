<?php

/*
 * Basics package's configuration
 */

use Izt\Basics\Storage\Eloquent\Models\User;

return [

    'user' => User::class,
    'oauth' => false,
    'redirect_route_after_logout' => 'front.home'

];
