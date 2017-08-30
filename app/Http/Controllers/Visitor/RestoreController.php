<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function index(Request $request, int $id) : RedirectResponse
    {
        $Visitor = Visitor::onlyTrashed()->findOrFail($id);
        $Visitor->restore();

        \Flash::success('来場者情報を1件復旧しました。');

        return redirect()->route('visitor');
    }

}
