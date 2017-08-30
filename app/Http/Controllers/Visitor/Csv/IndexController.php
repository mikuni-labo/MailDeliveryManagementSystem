<?php

namespace App\Http\Controllers\Visitor\Csv;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class IndexController extends Controller
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

        $this->setBreadcrumb('Visitor', route('visitor'));
        $this->setBreadcrumb('Csv', route('visitor.csv'));
    }

    /**
     * Show view.
     *
     * @method GET
     * @return View
     */
    public function index() : View
    {
        return view('visitor.csv.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

}
