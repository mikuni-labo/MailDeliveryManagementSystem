<?php

namespace App\Http\Controllers\Visitor;

use App\Models\Visitor;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
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
     * @method DELETE
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        $Visitor = Visitor::findOrFail($id);
        $Visitor->delete();

        \Flash::info('来場者を1件削除しました。');
        return redirect()->route('visitor');
    }

}
