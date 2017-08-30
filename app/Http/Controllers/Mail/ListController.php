<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
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
     * Show mail templatess list.
     *
     * @method GET
     * @return View
     */
    public function index() : View
    {
        return view('mail.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
            'results'    => MailTemplate::search()->paginate(),
        ]);
    }

}
