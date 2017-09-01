<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\EditRequest;
use App\Models\MailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditController extends Controller
{
    /** @var EditRequest */
    private $formRequest;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();

        $this->setBreadcrumb('Mail', route('mail'));
        $this->formRequest = new EditRequest;
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
        return view('mail.edit')->with([
            'breadcrumb' => $this->setBreadcrumb('Edit', route('mail.edit', [$id])),
            'row'        => MailTemplate::findOrFail($id),
        ]);
    }

    /**
     * Update a template.
     *
     * @method PUT
     * @param Request $request
     * @param EditRequest $formRequest
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, EditRequest $formRequest, int $id) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $MailTemplate->update($request->all());

        \Flash::success('テンプレート情報を更新しました。');

        return redirect()->route('mail');
    }
}
