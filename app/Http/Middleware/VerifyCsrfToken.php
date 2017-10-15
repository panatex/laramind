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
        //mettere le url non validate dal token
        '/test-middleware',
        '/ws/create-anagrafica',
        '/ws/create-anagrafica-bigdata'

    ];
}
