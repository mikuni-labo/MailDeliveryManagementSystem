<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
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

        $this->setBreadcrumb('Mail', route('mail'));
    }

    /**
     * Show mail template visitors sets list for delivery.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function index(Request $request, $id) : View
    {
        $MailTemplate = MailTemplate::findOrFail($id);

        dd('list');
        DeliverySet::all();
//         dd($MailTemplate->deliverySets()->first()->mailTemplate()->first());

        return view('mail.index')->with([
            'breadcrumb' => $this->setBreadcrumb('Delivery Set', route('mail.set', $id)),
            'results'    => MailTemplate::search()->paginate(),
        ]);
    }

}
