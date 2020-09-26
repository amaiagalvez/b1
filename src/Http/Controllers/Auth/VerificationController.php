<?php

namespace Izt\Basics\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Izt\Basics\Http\Controllers\Controller;
use Izt\Basics\Storage\Eloquent\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    public function verify(Request $request)
    {
        $user_id = $request['id'];
        $user = User::findOrFail($user_id);

        if (Auth::id() === (int)$user_id) {
            $user->markEmailAsVerified();

            $user->active = 1;
            $user->save();

            return redirect()->back();
        }

        return redirect()->route('login');
    }

    public function resend(Request $request)
    {

        $user = User::findOrFail($request->get('user_id'));

        $user->sendEmailVerificationNotification();

        return redirect()->back();
    }
}
