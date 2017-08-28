<?php

namespace App\Http\Controllers\Visitor;

use App\Models\Visitor;
use App\Http\Controllers\Controller;

class ListController extends Controller
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
    }

    /**
     * Show visitors list.
     *
     * @method GET
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('visitor.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
            'results'    => Visitor::search()->paginate(),
        ]);
    }

}
