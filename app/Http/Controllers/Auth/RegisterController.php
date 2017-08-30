<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /** @var RegisterRequest */
    private $formRequest;

    /** @var User */
    private $User;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $User)
    {
        $this->redirectTo = route('home');

        $this->middleware('guest');

        parent::__construct();

        $this->formRequest = new RegisterRequest();
        $this->User = $User;
    }

    /**
     * Show the application registration form.
     *
     * @method GET
     * @return View
     */
    public function showRegistrationForm() : View
    {
        $this->setBreadcrumb('Register', route('register'));

        return view('auth.register')->with([
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->formRequest->rules(), $this->formRequest->messages(), $this->formRequest->attributes());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param  User $User
     * @return User
     */
    protected function create(array $data)
    {
        $this->User->name     = $data['name'];
        $this->User->email    = $data['email'];
        $this->User->password = bcrypt($data['password']);
        $this->User->save();

        return $this->User;
    }

}
