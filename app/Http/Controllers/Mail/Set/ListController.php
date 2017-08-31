<?php

namespace App\Http\Controllers\Mail\Set;

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
     * Show mail template visitors sets list.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function index(Request $request, $id) : View
    {
        $this->setBreadcrumb('Delivery Set', route('mail.set', $id));

        dd('here');

        return view('mail.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
            'results'    => MailTemplate::search()->paginate(),
        ]);
    }

}
