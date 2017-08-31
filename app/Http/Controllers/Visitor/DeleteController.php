<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * Delete a visitor.
     *
     * @method DELETE
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(Request $request, int $id) : RedirectResponse
    {
        $Visitor = Visitor::findOrFail($id);
        $Visitor->delete();

        \Flash::info('来場者を1件削除しました。');

        return session()->has('requestUri.visitor.list') ? redirect(session()->get('requestUri.visitor.list')) : redirect()->route('visitor');
    }

}
