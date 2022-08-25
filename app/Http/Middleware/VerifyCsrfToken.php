<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/pay-via-ajax', '/success','/cancel','/fail','/ipn', '/package/payment/*', '/package/payment-fail', '/package/payment-cancel', '/hotel/payment/*', '/hotel/payment-fail', '/hotel/payment-cancel', '/verification/*', 'hotel/api/hotel/book/payment/ipn/*'
    ];
}
