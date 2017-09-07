<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Mail\DeliveryMailable;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use App\Services\Mail\DeliveryMailService;
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
     * @param DeliveryMailService $DeliveryMailService
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function delivery(Request $request, DeliveryMailService $DeliveryMailService, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);

        /** @var DeliverySet $DeliverySet */
        $DeliverySet = DeliverySet::findOrFail($setId);

        /**
         * 配信処理
         */
        if( ! $DeliverySet->deliverySetVisitors->count() ) {
            \Flash::info('配信対象がありません。');
        } else foreach ( $DeliverySet->deliverySetVisitors as $DeliverySetVisitor ) {
            $DeliveryMailService->send(new DeliveryMailable($DeliverySetVisitor->mailTemplate, $DeliverySetVisitor->visitor));
            \Flash::success('メールを配信しました。');
        }

        return redirect()->route('mail.set', $id);
    }
}
