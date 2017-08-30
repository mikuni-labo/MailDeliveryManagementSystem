<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /** @var ResendRequest */
    private $formRequest;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        parent::__construct();

        $this->formRequest = new ResendRequest;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @method GET
     * @param Request $request
     * @return View
     */
    public function showLinkRequestForm(Request $request) : View
    {
        $this->setBreadcrumb('Resend Password', route('password.email'));

        return view('auth.passwords.email')->with([
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, $this->formRequest->rules(), $this->formRequest->messages(), $this->formRequest->attributes());
    }

}
