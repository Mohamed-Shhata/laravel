<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userProviderInfo = Socialite::driver($provider)->stateless()->user();
        // dd($userProviderInfo);
        
        $user = $this->getUser($userProviderInfo, $provider);
        
        auth()->login($user);
        return redirect('/posts');
    }

    public function getUser($userProviderInfo, $provider)
    {
        $user = User::where('github_id', $userProviderInfo->id)->first() ? User::where('github_id', $userProviderInfo->id)->first() : User::where('email', $userProviderInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $userProviderInfo->name,
                'email' => $userProviderInfo->email,
                // 'github_id' => $userProviderInfo->id,
                'password' => '12345678',
                'github_token' => $userProviderInfo->token,
            ]);
        }
        return $user;
    }



}
