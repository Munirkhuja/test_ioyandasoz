<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\OauthRefreshTokenRequest;
use App\Traits\IssueTokenTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    /**
     * @OA\Post(
     * path="/api/login",
     *   tags={"login"},
     *   summary="login",
     *   security={{"passport": {}}},
     *   operationId="login",
     *
     *  @OA\Parameter(
     *      name="login",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function login(LoginRequest $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $user = User::where('login', $login)->first();
        if ($user) {
            $this->revokedToken($user->id);
        }
        $this->arrayparam['grant_type'] = 'password';
        $this->arrayparam['username'] = $login;
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
        $oat=DB::table('oauth_access_tokens')
            ->where('user_id', $user_id)->where('revoked',false)->pluck('id')->toArray();
        if($oat&&count($oat)>0){
            DB::table('oauth_access_tokens')
                ->whereIn('id', $oat)
                ->update([
                    'revoked' => true
                ]);
        }
    }
}
