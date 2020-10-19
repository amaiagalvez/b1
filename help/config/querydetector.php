<?php

use BeyondCode\QueryDetector\Outputs\Alert;
use BeyondCode\QueryDetector\Outputs\Debugbar;

return [
    /*
     * Enable or disable the query detection.
     * If this is set to "null", the app.debug config value will be used.
     */
    'enabled' => env('QUERY_DETECTOR_ENABLED', null),

    /*
     * Threshold level for the N+1 query detection. If a relation query will be
     * executed more then this amount, the detector will notify you about it.
     */
    'threshold' => (int)env('QUERY_DETECTOR_TRESHOLD', 1),

    /*
     * Here you can whitelist model relations.
     *
     * Right now, you need to define the model relation both as the class name and the attribute name on the model.
     * So if an "Author" model would have a "posts" relation that points to a "Post" class, you need to add both
     * the "posts" attribute and the "Post::class", since the relation can get resolved in multiple ways.
     */
    'except' => [
        //Author::class => [
        //    Post::class,
        //    'posts',
        //]
    ],

    /*
     * Define the output format that you want to use. Multiple classes are supported.
     * Available options are:
     *
     * Alert:
     * Displays an alert on the website
     * \BeyondCode\QueryDetector\Outputs\Alert::class
     *
     * Console:
     * Writes the N+1 queries into your browsers console log
     * \BeyondCode\QueryDetector\Outputs\Console::class
     *
     * Clockwork: (make sure you have the itsgoingd/clockwork package installed)
     * Writes the N+1 queries warnings to Clockwork log
     * \BeyondCode\QueryDetector\Outputs\Clockwork::class
     *
     * Debugbar: (make sure you have the barryvdh/laravel-debugbar package installed)
     * Writes the N+1 queries into a custom messages collector of Debugbar
     * \BeyondCode\QueryDetector\Outputs\Debugbar::class
     *
     * JSON:
     * Writes the N+1 queries into the response body of your JSON responses
     * \BeyondCode\QueryDetector\Outputs\Json::class
     *
     * Log:
     * Writes the N+1 queries into the Laravel.log file
     * \BeyondCode\QueryDetector\Outputs\Log::class
     */
    'output' => [
        Alert::class,
        Debugbar::class
    ]
];
