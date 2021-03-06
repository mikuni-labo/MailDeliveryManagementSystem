<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
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
        return view('home', [
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

    /**
     * Show phpinfo.
     *
     * @method GET
     * @param Request $request
     * @return void
     */
    public function phpinfo(Request $request)
    {
        phpinfo();
    }
}
