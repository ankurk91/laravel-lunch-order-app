<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Auth\Events\Registered as RegisteredEvent;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{

    use RedirectsUsers;

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider String
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider string
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            // Send actual error message in development
            if (config('app.debug')) {
                throw $e;
            }
            // Lets Suppress this error
            alert()->error('Unable to authenticate. Please try again.');
            return redirect()->route('login');
        }

        DB::beginTransaction();

        $user = $this->findOrCreateUser($provider, $providerUser);
        Auth::login($user, true);

        // This session variable can help to determine if user is logged-in via socialite
        session()->put([
            'auth.social_id' => $providerUser->getId()
        ]);

        DB::commit();

        return $this->authenticated($user)
            ?: redirect()->intended($this->redirectPath());

    }

    /**
     * Create a user if does not exist
     *
     * @param $providerName string
     * @param $providerUser
     * @return mixed
     */
    protected function findOrCreateUser($providerName, $providerUser)
    {
        $social = SocialAccount::firstOrNew([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $providerName
        ]);

        if ($social->exists) {
            return $social->user;
        }

        $user = User::firstOrNew([
            'email' => $providerUser->getEmail()
        ]);

        if (!$user->exists) {
            $user->password = bcrypt(str_random(30));
            $user->save();
            $user->assignRole(config('project.default_role'));
            $user->profile()->create($this->getProfileData($providerUser));
            event(new RegisteredEvent($user));
        }

        $social->user()->associate($user);
        $social->save();

        return $user;

    }

    /**
     * The user has been authenticated.
     *
     * @param  User $user
     * @return mixed
     */
    protected function authenticated(User $user)
    {
        if ($user->is_blocked) {

            Auth::logout();
            session()->invalidate();

            alert()->error('Your account is disabled. Please contact administrator for assistance.');
            return redirect()->route('login');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('shop.index');
    }

    /**
     * Extract user profile data
     *
     * @param $providerUser
     * @return array
     */
    protected function getProfileData($providerUser)
    {
        $nameParts = explode(' ', $providerUser->getName());
        return [
            'first_name' => $nameParts[0],
            'last_name' => optional($nameParts)[1],
            // Get full size avatar url by removing `?sz=` query parameter
            'avatar' => preg_replace('/\?sz=[\d]*$/', '', $providerUser->getAvatar()),
        ];
    }
}
