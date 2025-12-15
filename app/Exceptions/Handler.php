<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException; // <--- PENTING

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * FUNGSI TAMBAHAN: Mengubah respon error login jadi JSON selamanya.
     * Menggantikan perilaku default Laravel yang suka redirect ke login.
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Langsung balas dengan JSON, tidak peduli siapa yang akses
        return response()->json([
            'status' => false,
            'message' => 'Unauthenticated.'
        ], 401);
    }
}