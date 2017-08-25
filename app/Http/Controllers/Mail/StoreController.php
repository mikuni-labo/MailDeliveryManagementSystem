<?php

namespace App\Http\Controllers\Mail;

use App\Http\Requests\Mail\StoreRequest;
use App\Models\MailTemplate;
use App\Http\Controllers\Controller;

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
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('mail.add')->with([
            'breadcrumb' => $this->setBreadcrumb('Add', route('mail.add')),
        ]);
    }

    /**
     * Store
     *
     * @method POST
     * @param StoreRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(StoreRequest $formRequest)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::create( request()->all() );

        \Flash::success('メールテンプレートを登録しました。');

        return redirect()->route('mail');
    }
}
