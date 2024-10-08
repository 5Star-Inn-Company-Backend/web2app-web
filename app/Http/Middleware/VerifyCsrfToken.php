<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
         'api/register',
         'api/login',
         'api/forgot-password',
         'api/reset-password',
         'api/verify-email/{id}/{hash}',
         'api/email/verification-notification',
         'api//logout'
    ];
}
