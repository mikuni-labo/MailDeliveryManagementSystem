<?php

namespace App\Http\Controllers\Mail;

use App\Http\Requests\Mail\EditRequest;
use App\Models\MailTemplate;
use App\Http\Controllers\Controller;

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
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
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
        /** @var EditRequest $EditRequest */
        $EditRequest = MailTemplate::findOrFail($id);
        $EditRequest->update(request()->all());

        \Flash::success('メールテンプレート情報を更新しました。');

        return redirect()->route('mail');
    }
}
