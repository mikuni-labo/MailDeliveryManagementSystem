<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\Set\StoreRequest;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    /** @var StoreRequest */
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
    }

    /**
     * Show register form.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function index(Request $request, int $id) : View
    {
        $MailTemplate = MailTemplate::findOrFail($id);

        $this->setBreadcrumb('Delivery Set', route('mail.set', $id));

        return view('mail.set.add')->with([
            'breadcrumb'   => $this->setBreadcrumb('Add', route('mail.set.add', $id)),
            'MailTemplate' => $MailTemplate,
        ]);
    }

    /**
     * Store a mail template visitors set for delivery.
     *
     * @method POST
     * @param Request $request
     * @param StoreRequest $formRequest
     * @param integer $id
     * @return RedirectResponse
     */
    public function store(Request $request, StoreRequest $formRequest, int $id) : RedirectResponse
    {
        MailTemplate::findOrFail($id);

        $inputs = $request->all();
        $inputs['data'] = [];

        /** @var DeliverySet $DeliverySet */
        DeliverySet::create($inputs);

        \Flash::success('配信セットを新規登録しました。');

        return redirect()->route('mail.set', $id);
    }
}
