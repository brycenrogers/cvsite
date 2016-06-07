<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mailer', function ($app) {
            $app->configure('services');
            return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
        });

        Validator::extend('recaptcha', function($attribute, $value, $parameters, $validator) {

            $recaptcha = new \ReCaptcha\ReCaptcha(env('RECAPTCHA_SECRET', ''));
            $resp = $recaptcha->verify($value);
            if ($resp->isSuccess()) {
                return true;
            } else {
                return false;
            }
        });
    }
}
