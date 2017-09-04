<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\Set\EditRequest;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorsSetController extends Controller
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
     * Show visitors set list.
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
        $DeliverySet = DeliverySet::findOrFail($setId);

        $DeliverySet->visitors()->get()

        return view('mail.set.visitor')->with([
            'breadcrumb'   => $this->setBreadcrumb('Delivery Visitors Set', route('mail.set.visitor', [$id, $setId])),
            'MailTemplate' => $MailTemplate,
            'DeliverySet'  => $DeliverySet,
        ]);
    }

}
