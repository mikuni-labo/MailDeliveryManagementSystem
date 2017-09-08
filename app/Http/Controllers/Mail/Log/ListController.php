<?php

namespace App\Http\Controllers\Mail\Log;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMailLog;
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
     * Show delivery mail logs.
     *
     * @method GET
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        return view('mail.log.index')->with([
            'breadcrumb'   => $this->setBreadcrumb('Log', route('mail.log')),
            'result'       => DeliveryMailLog::query()->latest()->paginate(),
        ]);
    }

}
