<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth, Hash, Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the FB, Google authentication page.
     *
     * @param string $provider  OAuth Provider
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from FB, Google.
     *
     * @param string $provider  OAuth Provider
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $userObject = $this->getUser($user);

        // If user does not exist, Create.
        if ($userObject === null) {
            $userObject = $this->createUser($user);
        }

        // Authenticate User.
        Auth::login($userObject, true);

        return view('home');
    }

    /**
     * Retrieve user by email.
     *
     * @param object $user
     * @return mixed
     */
    private function getUser($user)
    {
        return User::where('email',$user->getEmail())->first();
    }

    /**
     * Create new user from OAuth driver object.
     *
     * @param object $user
     * @return mixed
     */
    private function createUser($user)
    {
        // Generate a random password.
        $newPassword = str_random(8);

        // Create new user.
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make($newPassword)
        ]);

        // If user creation succeeds send the generated password
        // to user's mail using $user->email so that user
        // can also login using email and password.

        return $newUser;
    }
}
