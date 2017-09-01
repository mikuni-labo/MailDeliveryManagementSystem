<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
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
     * Delete a mail template visitors set for delivery.
     *
     * @method DELETE
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function delete(Request $request, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);

        /** @var DeliverySet $DeliverySet */
        $DeliverySet = DeliverySet::findOrFail($setId);
        $DeliverySet->delete();

        \Flash::info('配信セットを1件削除しました。');

        return redirect()->route('mail.set', $id);
    }

}
