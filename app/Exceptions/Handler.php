<?php

namespace Car\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
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
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        //dd('report');
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //added 15082020
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
          return abort('404');
          return response()->json( [
                                        'success' => 0,
                                        'message' => 'Method is not allowed for the requested route',
                                    ], 405 );
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        
        if($request->expectsJson()){
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = array_get($exception->guards(),0);
        $route = '';
        //dd($guard);
        if($guard == 'admin'){
            $route = '/admin';
        }else{
            $route = 'login';
        }
        return redirect($route);
        // return $request->expectsJson()
        //             ? response()->json(['message' => $exception->getMessage()], 401)
        //             : redirect()->guest(route('login'));
    }
}
