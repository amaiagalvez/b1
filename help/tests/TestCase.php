<?php

namespace Tests;

use App\Exceptions\Handler;
use Exception;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Storage\Eloquent\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected $oldExceptionHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->runDatabaseMigrations();

        // Testak egiteak 60 eskaera minutuko gainditu ahal izateko
        // App/HTTP/Kernel.php-n dago muga hori

        $this->withoutMiddleware(
            ThrottleRequests::class
        );

        DB::beginTransaction();

        //NOTE
        // if we need to test something that an unauthenticated user mustn't see,
        // we have to move signIn() to every class...or have to TestCase-es, AuthTestCase an GuestTestCase...

        if (method_exists($this, 'runDatabaseMigrations')) {

            $this->signIn();
        }

        $this->disableExceptionHandling();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: fCreate(User::class, [
            'lang' => 'eu',
            'role_name' => 'admin'
        ]);

        $this->actingAs($user);

        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = App::make(ExceptionHandler::class);

        App::instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
                //
            }

            public function report(Exception $e)
            {
                //
            }

            public function render($request, Exception $e)
            {
                throw $e;
            }
        });
    }


    protected function withExceptionHandling()
    {
        App::instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }


    protected function tearDown(): void
    {
        DB::rollback();

        parent::tearDown();
    }

    public function runDatabaseMigrations()
    {

        if (env('DB_TEST_EMPTY', true)) {

            if (RefreshDatabaseState::$migrated === false) {

                $this->artisan('migrate:fresh');

                RefreshDatabaseState::$migrated = true;

            }

            $this->app[Kernel::class]->setArtisan(null);
        }

        $this->artisan('db:seed');
    }

    protected function assertClassUsesTrait($trait, $class)
    {
        return $this->assertArrayHasKey(
            $trait,
            class_uses($class),
            "{$class} must use the {$trait} trait."
        );
    }
}
