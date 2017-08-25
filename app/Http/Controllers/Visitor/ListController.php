<?php

namespace App\Http\Controllers\Visitor;

use App\Models\Visitor;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    /** @var StoreRequest */
//     private $formRequest;

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
        dd('未実装');
    }

}
