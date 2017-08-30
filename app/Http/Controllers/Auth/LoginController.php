<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /** @var LoginRequest */
    private $formRequest;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('home');

        $this->middleware('guest')->except('logout');

        parent::__construct();

        $this->formRequest = new LoginRequest;
    }

    /**
     * Show the application's login form.
     *
     * @method GET
     * @param Request $request
     * @return View
     */
    public function showLoginForm(Request $request) : View
    {
        $this->setBreadcrumb('Login', route('login'));

        return view('auth.login')->with([
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, $this->formRequest->rules(), $this->formRequest->messages(), $this->formRequest->attributes());
    }

}
