<?php

namespace App\Http\Controllers;

use SocialAuth;

class SocialsController extends Controller
{
    public function social($provider)
    {
        return SocialAuth::authorize($provider);
    }

    public function callback($provider)
    {
        SocialAuth::login($provider, function ($user, $details) {

            $user->avatar = $details->avatar;

            $user->email = $details->email;

            $user->name = $details->full_name;

        });

        return redirect('/discussions');
    }
}
