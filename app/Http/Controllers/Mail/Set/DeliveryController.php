<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use App\Services\Mail\MailServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    private $MailServiceInterface;

    /**
     * Create a new controller instance.
     *
     * @param MailServiceInterface $MailServiceInterface
     * @return void
     */
    public function __construct(MailServiceInterface $MailServiceInterface)
    {
        $this->middleware('auth');

        parent::__construct();

        $this->MailServiceInterface = $MailServiceInterface;
    }

    /**
     * Delivery mail.
     *
     * @method PUT
     * @param Request $request
     * @param MailServiceInterface $MailServiceInterface
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

        /**
         * 配信処理
         */
        foreach ($DeliverySet->visitors()->get() as $DeliverySetVisitor) {
            $this->MailServiceInterface->send();
//                 $DeliverySetVisitor->mailTemplate
//                 $DeliverySetVisitor->deliverySet
//                 $DeliverySetVisitor->visitor
        }

        dd('end');

        \Flash::success('メールを配信しました。');

        return redirect()->route('mail.set', $id);
    }
}
