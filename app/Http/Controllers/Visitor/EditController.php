<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visitor\EditRequest;
use App\Models\Visitor;
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
     * @param int $id
     * @return View
     */
    public function index(int $id) : View
    {
        return view('visitor.edit')->with([
            'breadcrumb' => $this->setBreadcrumb('Edit', route('visitor.edit', [$id])),
            'row'        => Visitor::findOrFail($id),
        ]);
    }

    /**
     * Update
     *
     * @method PUT
     * @param EditRequest $formRequest
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $formRequest, $id)
    {
        /** @var Visitor $Visitor */
        $Visitor = Visitor::findOrFail($id);
        $Visitor->update(request()->all());

        \Flash::success('来場者情報を更新しました。');

        return redirect()->route('visitor');
    }
}
