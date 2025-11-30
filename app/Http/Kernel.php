<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Trust proxies (Load balancers, etc.)
        \App\Http\Middleware\TrustProxies::class,

        // Handle CORS
        \Illuminate\Http\Middleware\HandleCors::class,

        // Prevent handling requests when app is in maintenance mode
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validates the size of POST requests
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // Trim strings from input
        \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Encrypt cookies
            \App\Http\Middleware\EncryptCookies::class,

            // Add queued cookies to the response
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // Start the session
            \Illuminate\Session\Middleware\StartSession::class,

            // Share errors from the session with the views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // Verify CSRF token
            \App\Http\Middleware\VerifyCsrfToken::class,

            // Substitute route model bindings
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Throttle API requests
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',

            // Substitute route model bindings
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * These can be used to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        // Authentication
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,

        // Cache headers
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        // Authorization / Gates
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        // Guest redirect
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // Password confirmation
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        // Precognitive requests (optional, default in new Laravel versions)
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,

        // Signed URLs
        'signed' => \App\Http\Middleware\ValidateSignature::class,

        // Throttling
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Email verification
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // ✅ Spatie Permission middleware
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ];
}
