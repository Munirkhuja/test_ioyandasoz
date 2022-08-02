<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Traits\IssueTokenTrait;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use IssueTokenTrait;
    public function logout()
    {
        $accessToken = Auth::user()->token();
        $this->revokeLogout($accessToken->id);
        $accessToken->revoke();
        return response()->json(['message' =>  __('message.success_logout'), 'success' => true], 201);
    }
}
