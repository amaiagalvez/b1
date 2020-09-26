<?php

namespace Izt\Basics\Http\Controllers\Auth;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Izt\Basics\Http\Controllers\Controller;
use Izt\Basics\Storage\Eloquent\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectTo($service)
    {
        if (collect(['facebook', 'twitter', 'google'])->contains($service)) {
            return Socialite::driver($service)
                ->redirect();
        }

        Session::flash('errorMessage', trans('basics::auth.login_error', ['service' => $service]));
        return redirect()->route('login');
    }

    public function handleCallback($service)
    {
        try {
            $oAuth = Socialite::driver($service)
                ->user();
        } catch (Exception $e) {
            Session::flash('errorMessage', trans('basics::auth.login_error', ['service' => $service]));
            return redirect()->route('login');
        }

        $user = User::firstOrNew(['auth_id' => $oAuth->getId(), 'role_name' => 'web', 'active' => 1, 'lang' => 'eu']);

        if (!$user->exists) {

            $user = User::firstOrNew([
                'email' => $oAuth->getEmail(),
                'role_name' => 'web',
                'active' => 1,
                'lang' => 'eu'
            ]);

            if (!$user->exists) {
                $user->name = $oAuth->getName();
            }

            $user->auth_id = $oAuth->getId();
            $user->avatar = $oAuth->getAvatar();
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('front.home');
    }

    private function getName($service)
    {

    }
}
