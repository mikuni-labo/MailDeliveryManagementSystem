<?php

namespace App\Http\Controllers\Mail;

use App\Http\Requests\Mail\EditRequest;
use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
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
     * @param int $id
     * @return View
     */
    public function index(int $id) : View
    {
        return view('mail.edit')->with([
            'breadcrumb' => $this->setBreadcrumb('Edit', route('mail.edit', [$id])),
            'row'        => MailTemplate::findOrFail($id),
        ]);
    }

    /**
     * Update
     *
     * @method PUT
     * @param EditRequest $formRequest
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(EditRequest $formRequest, $id)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $MailTemplate->update(request()->all());

        \Flash::success('テンプレート情報を更新しました。');

        return redirect()->route('mail');
    }
}
