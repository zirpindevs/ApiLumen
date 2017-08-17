<?php
namespace handlers;

use Exception;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class ErrorHandler extends ExceptionHandler
{

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (!$request->expectsJson()) {
            return parent::render($request, $e);
        }
        $code = $e->getCode();

        $output = [
            'success' => false,
            'msg' => $e->getMessage()
        ];

        if (!$this->isHttpErrorCode($e->getCode())) {
            $code = 500;
            $output['msg'] .= ' || ' . $e->getTraceAsString();
        }

        //Show JSON error
        return response()->json($output, $code);

    }

    /**
     * Check if error code is a valid HTTP error code ( 4xx, 5xx )
     * @param $code
     * @return int
     */
    protected function isHttpErrorCode($code)
    {
        return preg_match('/\b((4|5)\d{2})\b/', $code);
    }
}