<?php

namespace Spatie\MailcoachPostmarkFeedback;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MailcoachPostmarkFeedbackServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::macro(
            'postmarkFeedback',
            fn (string $url) => Route::post($url, '\\' . PostmarkWebhookController::class)
        );
    }
}
