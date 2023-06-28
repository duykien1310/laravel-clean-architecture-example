<?php

namespace App\Http\Payload\User;

use Illuminate\Http\Request;

class CreateUserPayload extends Request {

    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ];
    }
}