<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $gitUser = User::updateOrCreate([
                'github_id' => $user->id,
            ],[
                'username' => $user->nickname,
                'email' => $user->email,
                'nickname' => $user->nickname,
                'github_token' => $user->token,
                'auth_type' => 'github',
                'password' => Hash::make('123456')
            ]);
//            $gitUser->update([ 'username'=>$user->nickname]);

            User::where('id', $gitUser->id)
                ->update([ 'username'=>$user->nickname]);
            Auth::login($gitUser);

            return redirect()->route('dashboard');
        } catch(\Exception $e) {
            dd($e);
//            ray($e->getMessage());
        }
    }

    public function personalToken(Request $request){
       $userId= auth()->user()->id;
        User::where('id', $userId)
            ->update([ 'github_token'=>$request->githubtoken]);
        return redirect()->route('dashboard');
    }

}
