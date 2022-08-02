<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\OauthRefreshTokenRequest;
use App\Traits\IssueTokenTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use IssueTokenTrait;

    private $arrayparam;

    public function __construct()
    {
        $this->arrayparam =[
            'client_id' => config('app.client_id'),
            'client_secret' => config('app.client_secret')
        ];
    }

    public function login(LoginRequest $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');
        $user = User::where('phone', $phone)->first();
        if ($user) {
            $revoked=$this->revokedToken($user->id);
            if (!$revoked){
                return response()->json([
                    'message' => __('auth.failed'),
                ], 500);
            }
        }
        $this->arrayparam['grant_type'] = 'password';
        $this->arrayparam['username'] = $phone;
        $this->arrayparam['password'] = $password;
        $this->arrayparam['scope'] = '';
        return $this->issueToken($this->arrayparam);
    }

    public function refreshToken(OauthRefreshTokenRequest $request)
    {
        $refresh_token=$request->input('refresh_token');
        $this->arrayparam['grant_type'] = 'refresh_token';
        $this->arrayparam['refresh_token']= $refresh_token;
        $this->arrayparam['scope'] = '';
        return $this->issueToken($this->arrayparam);
    }

    private function revokedToken($user_id)
    {
        try{
            $oat=DB::table('oauth_access_tokens')
                ->where('user_id', $user_id)->where('revoked',false)->pluck('id')->toArray();
            if($oat&&count($oat)>0){
                DB::table('oauth_access_tokens')
                    ->whereIn('id', $oat)
                    ->update([
                        'revoked' => true
                    ]);
            }
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }
}
