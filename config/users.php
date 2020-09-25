<?php

/*
 * IZT Users package's configuration
 */

return [

    'user' => Izt\Users\Storage\Eloquent\Models\User::class,
    'redirect_route_after_logout' => 'front.home'

];
