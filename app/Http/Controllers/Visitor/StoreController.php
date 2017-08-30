<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visitor\StoreRequest;
use App\Models\Visitor;
use Illuminate\View\View;

class StoreController extends Controller
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
     * Show register form.
     *
     * @method GET
     * @return View
     */
    public function index() : View
    {
        return view('visitor.add')->with([
            'breadcrumb' => $this->setBreadcrumb('Add', route('visitor.add')),
        ]);
    }

    /**
     * Store
     *
     * @method POST
     * @param StoreRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(StoreRequest $formRequest)
    {
        /** @var Visitor $Visitor */
        $Visitor = Visitor::create( request()->all() );

        \Flash::success('来場者を新規登録しました。');

        return redirect()->route('visitor');
    }
}
