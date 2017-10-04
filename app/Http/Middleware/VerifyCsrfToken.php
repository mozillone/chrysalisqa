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


<<<<<<< HEAD
    protected $except = ['/emailValidation','/forgot/emailVerification','/customer/emailValidation',
    '/search','/searching','/amenitiesValidation','/styleValidation','/listingNameValidation',
    '/planValidation','/costume/costumecreate','/costume/postrequestabag','/postrequestabaglogin',
    '/generatelables' ,'/payoutamount','/returnamount','/closerequest','/changecostumestatus',
    '/deleteaddress','/deleteccard','/delete_address','/admin/event/search','/admin/press/search',
    '/update_suport_status','support/search','ajax/message/send','costume/costumeeditadd',
    '/update_priority','requestabag_message','/ccupdate','/emailcheck','/usernameValidation',
 'conversation/delete','/support_message','/change-block-status', '/change-page-status','/change-blog-status',
        '/search-by-zip','/admin/jobs/search','check_priority','/add-blog-category','/changefeaturestatus',
        '/getallsearchcostumes','/faq-search','/change-faq-status','subscribenews','/admin/paypal/search'
=======
    protected $except = ['/emailValidation','/forgot/emailVerification','/customer/emailValidation','/search','/searching','/amenitiesValidation','/styleValidation','/listingNameValidation','/planValidation','/costume/costumecreate','/costume/postrequestabag','/postrequestabaglogin','/generatelables' ,'/payoutamount','/returnamount','/closerequest','/changecostumestatus','/deleteaddress','/deleteccard','/delete_address','/admin/event/search','/admin/press/search'

        //
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
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
