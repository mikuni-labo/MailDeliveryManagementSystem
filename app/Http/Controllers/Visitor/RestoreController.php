<?php

namespace App\Http\Controllers\Visitor;

use App\Models\Visitor;
use App\Http\Controllers\Controller;

class RestoreController extends Controller
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
     * Show visitors list.
     *
     * @method PATCH
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        $Visitor = Visitor::onlyTrashed()->findOrFail($id);
        $Visitor->restore();

        \Flash::success('来場者情報を1件復旧しました。');
        return redirect()->route('visitor');
    }

}
