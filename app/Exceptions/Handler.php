<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
//            return response(['message' => $e->getMessage()], $e->getCode() ?: 400);
        });
    }

    private function customApiResponse($exception): \Illuminate\Http\JsonResponse
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['data']['message'] = 'عدم دسترسی';
                break;
            case 403:
                $response['data']['message'] = 'دسترسی غیرمجاز';
                break;
            case 405:
            case 404:
                $response['data']['message'] = 'صفحه مورد نظر یافت نشد!';
                break;
            case 422:
                $response['data']['message'] = $exception->original['message'];
                $response['data']['errors'] = $exception->original['errors'];
                break;
            default:
                $response['data']['message'] = ($statusCode == 500) ? 'خطایی در سیستم رخ داده است!' : $exception->getMessage();
                break;
        }

        if (config('app.debug')) {
            $response['data']['trace'] = $exception->getTrace();
            $response['data']['code'] = $exception->getCode();
        }

        $response['success'] = false;

        return response()->json($response,$statusCode);
    }
    private function handleApiException($request, $exception)
    {
        $exception = $this->prepareException($exception);
        if ($exception instanceof \HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    public function render($request, $e)
    {
        Log::debug($request->fullUrl().' - '.$e->getMessage(),$request->toArray());
        if(!$request->expectsJson() && !$request->is('api/*')) return parent::render($request, $e);
        return $this->handleApiException($request, $e);
    }
}
