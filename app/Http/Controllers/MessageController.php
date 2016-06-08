<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * 
     */
    public function postSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|min:1',
            'recaptcha' => 'required|recaptcha'
        ],
        [
            'recaptcha' => "Recaptcha failed",
            'recaptcha.required' => "Recaptcha required"
        ]);

        // Email data
        $contactEmail = env('CONTACT_EMAIL', 'brycenrogers@gmail.com');
        $contactEmailName = env('CONTACT_EMAIL_NAME', 'Brycen Rogers');
        $data = [
            'email' => $request->input('email'),
            'emailName' => $request->input('name'),
            'emailMessage' => $request->input('message')
        ];

        // Send email
        Mail::send('emails.contact', $data, function($message) use ($contactEmail, $contactEmailName)
        {
            $message->to($contactEmail, $contactEmailName)->subject('Contact Form Request');
        });
    }
}
