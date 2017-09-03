<?php

namespace App\Http\Controllers;

use App\Mail\TestMailable;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @method GET
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        dd('test!');

        return view('test');
    }

    /**
     * Show the application dashboard.
     *
     * @method GET
     * @param Request $request
     * @return
     */
    public function sendTestMailViaFacade(Request $request)
    {
        /** @var User $User */
        $User = auth()->user();

        return \Mail::to($User)->send(new TestMailable($User));
    }

    /**
     * Show the application dashboard.
     *
     * @method GET
     * @param Request $request
     * @return
     */
    public function sendTestMailViaNotification(Request $request)
    {
        /** @var User $User */
        $User = auth()->user();

        return $User->notify(new TestNotification($User));
    }

}
