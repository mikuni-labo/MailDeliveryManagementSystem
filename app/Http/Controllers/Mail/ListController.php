<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
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
     * Show mail templates list.
     *
     * @method GET
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        return view('mail.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
            'result'     => app()->isLocal() ? MailTemplate::query()->withTrashed()->paginate()
                                                : MailTemplate::query()->paginate(),
        ]);
    }

}
