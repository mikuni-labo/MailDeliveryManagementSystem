<?php

namespace App\Http\Controllers\Mail\Log;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMailLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorListController extends Controller
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
        $this->setBreadcrumb('Log', route('mail.log'));
    }

    /**
     * Show delivery mail log with visitors.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function index(Request $request, int $id) : View
    {
        $DeliveryMailLog = DeliveryMailLog::findOrFail($id);

        return view('mail.log.visitor')->with([
            'breadcrumb'   => $this->setBreadcrumb('Log Visitor List', route('mail.log.visitor', $id)),
            'result'       => $DeliveryMailLog->deliveryMailLogVisitors()->paginate(),
        ]);
    }

}
