<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Requests\Auth\ModifyRequest;
use App\User;
use App\Http\Controllers\Controller;

class ModifyController extends Controller
{
    /** @var ModifyRequest */
//     private $formRequest;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->formRequest = new ModifyRequest();

        $this->middleware('auth');
    }

    /**
     * Show form.
     *
     * @method GET
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('auth.modify');
    }

}
