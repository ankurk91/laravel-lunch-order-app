<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
        'current_password',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $this->handleValidationException($exception);
        $this->renderMethodNotAllowedException($exception);

        return parent::render($request, $exception);
    }

    /**
     * Display a generic message on all forms.
     *
     * @param Exception $exception
     */
    private function handleValidationException(Exception $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            alert()->error('Please correct the validation errors in the form and then retry.');
        }
    }

    /**
     * Laravel still display Symfony error page on such exceptions.
     *
     * @param Exception $exception
     */
    private function renderMethodNotAllowedException(Exception $exception)
    {
        abort_if(!config('app.debug') &&
            $exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException, 404);
    }

}
