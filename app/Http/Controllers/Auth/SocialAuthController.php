<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{
    private const PROVIDERS = ['google', 'facebook', 'apple'];

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, self::PROVIDERS, true), 404);

        $driver = Socialite::driver($provider);

        // Apple's web flow posts back to the callback rather than redirecting with a GET.
        if ($provider === 'apple') {
            $driver->stateless();
        }

        return $driver->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, self::PROVIDERS, true), 404);

        try {
            $driver = Socialite::driver($provider);
            $socialUser = $provider === 'apple'
                ? $driver->stateless()->user()
                : $driver->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'That sign-in attempt expired — please try again.']);
        } catch (\Throwable $e) {
            Log::warning("Social login failed for provider [{$provider}]", ['message' => $e->getMessage()]);

            return redirect()->route('login')
                ->withErrors(['email' => 'We couldn\'t sign you in with '.ucfirst($provider).'. Please try again.']);
        }

        $idColumn = $provider.'_id';

        $user = User::where($idColumn, $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if ($user) {
            // Link this provider to an existing account (e.g. one originally created with a password).
            if (! $user->{$idColumn}) {
                $user->update([$idColumn => $socialUser->getId()]);
            }
        } else {
            $user = User::create([
                'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: 'New Customer',
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
                $idColumn => $socialUser->getId(),
            ]);
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
