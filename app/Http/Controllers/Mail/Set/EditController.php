<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\Set\EditRequest;
use App\Models\DeliverySet;
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
     * @param integer $setId
     * @return View
     */
    public function index(Request $request, int $id, int $setId) : View
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);

        $this->setBreadcrumb('Delivery Set', route('mail.set', $id));

        return view('mail.set.edit')->with([
            'breadcrumb'   => $this->setBreadcrumb('Edit', route('mail.set.edit', [$id, $setId])),
            'MailTemplate' => $MailTemplate,
            'row'          => DeliverySet::findOrFail($setId),
        ]);
    }

    /**
     * Update a mail template visitors set for delivery.
     *
     * @method PUT
     * @param Request $request
     * @param EditRequest $formRequest
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function update(Request $request, EditRequest $formRequest, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        MailTemplate::findOrFail($id);

        /** @var DeliverySet $DeliverySet */
        $DeliverySet = DeliverySet::findOrFail($setId);
        $DeliverySet->update($request->all());

        \Flash::success('配信セット情報を更新しました。');

        return redirect()->route('mail.set', $id);
    }
}
