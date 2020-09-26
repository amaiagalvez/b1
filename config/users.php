<?php

/*
 * IZT Users package's configuration
 */

return [

    'user' => Izt\Basics\Storage\Eloquent\Models\User::class,
    'redirect_route_after_logout' => 'front.home'

];
