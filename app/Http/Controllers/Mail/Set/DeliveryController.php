<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
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

        dd('here');

        \Flash::success('メールを配信しました。');

        return redirect()->route('mail.set', $id);
    }
}
