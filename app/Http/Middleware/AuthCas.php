<?php

namespace app\Http\Middleware;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;
use Storage;

class AuthCAS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if the laravel auth session is still valid, nothing else matters just pass the request
        if (Auth::check()) {
            return $next($request);
        }
        // okay no valid laravel auth, so configure CAS and see if there is a valid cas token
        $this->configCAS();
        if (\phpCAS::isAuthenticated()) {
            // valid CAS token, perform the login to Laravel auth and pass the request
            $this->performLaravelAuthLogin();
            return $next($request);
        }
        // not authenticated at all! now lets ask the user to authenticate.
        // BUT we want to handle it differently depending on the type of request
        if ($request->ajax()) {
            // AJAX requests get a code, the frontend is responsible for refreshing to trigger the CAS login (via the call to forceAuthentication())
            return response()->json(array('auth_error' => true));
        } else {
            // standard HTTP request, force them to authenticate via CAS
            // (this will redirect to the CAS server login, but if we want we can change it to use a gateway on our site)
            \phpCAS::forceAuthentication();
        }
    }

    /*
     * The user must be CAS authenticated before calling this function!
     */
    protected function performLaravelAuthLogin()
    {
        $netid = \phpCAS::getUser();
        $user = User::where('netid', $netid)->first();
        if ($user === null) {
            // create user account before trying to log in
            $user = new User;
            $user->netid = $netid;
            $attrs = $this->getAttributes();
            Log::debug(json_encode($attrs));
            $user->email = $attrs['mail'];
            $user->save();
        }
        Auth::loginUsingId($user->id);
    }

    protected function configCAS()
    {
        // Full Hostname of your CAS Server
        $cas_host = 'login.uconn.edu';
        // Context of the CAS Server
        $cas_context = '/cas';
        // Port of your CAS server. Normally for a https server it's 443
        $cas_port = 443;

        // Initialize phpCAS
        \phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
        // For production use set the CA certificate that is the issuer of the cert on the CAS server
        if (\App::environment('production')) {
            // Disable debugging
            \phpCAS::setDebug(false);
            // Path to the ca chain that issued the cas server certificate (default here works for Ubuntu 14.04)
            $cas_server_ca_cert_path = '/etc/ssl/certs/USERTrust_RSA_Certification_Authority.pem';
            \phpCAS::setCasServerCACert($cas_server_ca_cert_path);
        } else {
            // Enable debugging
            \phpCAS::setDebug(storage_path() . '/logs/phpCAS.log');
            // For quick testing you can disable SSL validation of the CAS server.
            // THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
            // VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
            \phpCAS::setNoCasServerValidation();
        }
    }
    protected function getAttributes(){
        $mockData = [
            'mail' => 'null@uconn.edu',
        ];

        if (\App::environment('local')) {
            return $mockData;
        }
        return \phpCAS::getAttributes();
    }
}
