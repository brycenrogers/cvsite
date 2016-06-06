<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * 
     */
    public function postSend(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'message' => 'required|min:1',
                'recaptcha' => 'required|recaptcha'
            ],
            [
                'recaptcha' => "Recaptcha failed",
                'recaptcha.required' => "Recaptcha required"
            ]);

        // Send email
    }
}
