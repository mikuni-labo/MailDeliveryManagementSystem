<?php

namespace App\Http\Controllers\Mail\Set;

use App\Events\Delivery\DeliveryMailEvent;
use App\Http\Controllers\Controller;
use App\Mail\DeliveryMailable;
use App\Models\DeliveryMailLog;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryController extends Controller
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
     * Delivery mail.
     *
     * @method PUT
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function delivery(Request $request, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);

        /** @var DeliverySet $DeliverySet */
        $DeliverySet = DeliverySet::findOrFail($setId);

        \Flash::success('メール配信処理を行いました。');

        /**
         * 配信処理
         */
        if( ! $DeliverySet->deliverySetVisitors->count() ) {
            \Flash::info('配信対象がありません。');
        } else {
            $DeliveryMailLog = DeliveryMailLog::create([
                'mail_template_id' => $MailTemplate->id,
                'delivery_set_id'  => $DeliverySet->id,
                'from_name'        => config('mail.from.name'),
                'from_address'     => config('mail.from.address'),
                'subject'          => $MailTemplate->subject,
            ]);

            foreach ( $DeliverySet->deliverySetVisitors as $DeliverySetVisitor ) {
                event(new DeliveryMailEvent(new DeliveryMailable($DeliverySetVisitor->mailTemplate, $DeliverySetVisitor->deliverySet, $DeliverySetVisitor->visitor), $DeliveryMailLog));
            }
        }

        return redirect()->route('mail.set', $id);
    }
}
