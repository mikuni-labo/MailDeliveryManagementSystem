<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visitor\EditRequest;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditController extends Controller
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
     * Show modify form.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function index(Request $request, int $id) : View
    {
        return view('visitor.edit')->with([
            'breadcrumb' => $this->setBreadcrumb('Edit', route('visitor.edit', [$id])),
            'row'        => Visitor::findOrFail($id),
        ]);
    }

    /**
     * Update a visitor.
     *
     * @method PUT
     * @param Request $request
     * @param EditRequest $formRequest
     * @param integer integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, EditRequest $formRequest, int $id) : RedirectResponse
    {
        /** @var Visitor $Visitor */
        $Visitor = Visitor::findOrFail($id);
        $Visitor->update($request->all());

        \Flash::success('来場者情報を更新しました。');

        return session()->has('requestUri.visitor.list') ? redirect(session()->get('requestUri.visitor.list')) : redirect()->route('visitor');
    }
}
