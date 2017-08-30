<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\StoreRequest;
use App\Models\MailTemplate;
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
     * @return View
     */
    public function index(Request $request) : View
    {
        return view('mail.add')->with([
            'breadcrumb' => $this->setBreadcrumb('Add', route('mail.add')),
        ]);
    }

    /**
     * Store
     *
     * @method POST
     * @param Request $request
     * @param StoreRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request, StoreRequest $formRequest)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::create( request()->all() );

        \Flash::success('テンプレートを新規登録しました。');

        return redirect()->route('mail');
    }
}
