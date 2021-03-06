<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Log;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $e)
    {
        //dd($e);
        if($e instanceof NotFoundHttpException){
            return response()->view('errors.'.'404');
        }elseif ($e instanceof ModelNotFoundException) {
            return response()->view('errors.'.'404');
        } elseif ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        } elseif ($e instanceof AuthorizationException) {
            return response()->view('errors.'.'404');
        } elseif ($e instanceof ValidationException && $e->getResponse()) {
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }elseif($e instanceof InvalidArgumentException) {
            return response()->view('errors.'.'404');
        }else if($e instanceof \PDOException){
            return response()->view('errors.'.'404');
        }else if($e instanceof \NotFoundHttpException){
            return response()->view('errors.'.'404');
        }else{
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
        return parent::render($request, $e);
   }
   /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
