<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
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
     * Restore a mail template visitors set for delivery.
     *
     * @method PATCH
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function restore(Request $request, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::onlyTrashed()->findOrFail($id);

        /** @var DeliverySet $DeliverySet */
        $DeliverySet = DeliverySet::onlyTrashed()->findOrFail($setId);
        $DeliverySet->restore();

        \Flash::success('配信セットを1件復旧しました。');

        return redirect()->route('mail.set', $id);
    }

}
