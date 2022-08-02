<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\DriverRegisterRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(DriverRegisterRequest $request)
    {
        $user=User::firstOrCreate([
            'login' =>$request->input('login'),
        ],[
            'email' =>$request->input('email'),
            'password' =>bcrypt($request->input('password')),
        ]);
        if ($user){
            Driver::updateOrCreate([
                'user_id' =>$request->input('user_id'),
            ],[
                'first_name' =>$request->input('first_name'),
                'last_name' =>$request->input('last_name'),
            ]);
        }
    }
}
