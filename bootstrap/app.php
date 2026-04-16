<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias(
            [
                'auth.check' => \App\Http\Middleware\CheckIfAuthenticated::class,
                'redirect.role' => \App\Http\Middleware\RedirectIfAuthenticatedByRole::class,
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Exceptions;
// use Illuminate\Foundation\Configuration\Middleware;

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         web: __DIR__ . '/../routes/web.php',
//         commands: __DIR__ . '/../routes/console.php',
//         health: '/up',
//     )
//     ->withMiddleware(function (Middleware $middleware) {
//         // Thêm middleware UpdateCartCount vào nhóm web
//         $middleware->group('web', [
//             \App\Http\Middleware\UpdateCartCount::class,
//             // Các middleware khác...
//         ]);
//     })
//     ->withExceptions(function (Exceptions $exceptions) {
//         // Xử lý ngoại lệ tùy chỉnh tại đây
//     })
//     ->create();