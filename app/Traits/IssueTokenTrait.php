<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait IssueTokenTrait
{

    public function issueToken(array $arrayparam)
    {
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(route('passport.token'), [
                'form_params' => $arrayparam,
            ]);
            $tokens = json_decode((string)$response->getBody(), true);
            return response()->json([
                'data'=>$tokens,
                'success' => true
            ], 200);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return $this->authFailResponse((string)$e->getCode());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->authFailResponse((string)$e->getResponse()->getStatusCode());
        }
    }

    public function authFailResponse($status_code=401)
    {
        return response()->json([
            'message' => __('auth.failed'),
            'errors' => true
        ], $status_code);
    }

    public function revokeLogout($access_token_id){
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $access_token_id)
            ->update(['revoked' => true]);
    }
}
