<?php

namespace App\Http\Middleware;
use Closure;
use Redirect;
use Session;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    protected $except = ['/emailValidation','/forgot/emailVerification','/customer/emailValidation','/search','/searching','/amenitiesValidation','/styleValidation','/listingNameValidation','/planValidation','/costume/costumecreate','/costume/postrequestabag','/postrequestabaglogin','/generatelables' ,'/payoutamount','/returnamount','/closerequest','/changecostumestatus','/deleteaddress','/deleteccard'

        //
    ];



    // public function handle( $request, Closure $next )
    // {
    //     if (
    //         $this->isReading($request) ||
    //         $this->runningUnitTests() ||
    //         $this->shouldPassThrough($request) ||
    //         $this->tokensMatch($request)
    //     ) {
    //         return $this->addCookieToResponse($request, $next($request));
    //     }
    //     Session::flash('error', "Opps! Seems you couldn't submit form for a longtime. Please try again");
    //     return Redirect::back();
    // }
}
