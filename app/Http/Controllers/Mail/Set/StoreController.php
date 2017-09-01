<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\StoreRequest;
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
     * @return View
     */
    public function index(Request $request) : View
    {
        $this->setBreadcrumb('Delivery Set', route('mail.set', $id));

        dd('add');

        return view('mail.set.add')->with([
            'breadcrumb' => $this->setBreadcrumb('Add', route('mail.set.add')),
        ]);
    }

    /**
     * Store a template.
     *
     * @method POST
     * @param Request $request
     * @param StoreRequest $formRequest
     * @return RedirectResponse
     */
    public function store(Request $request, StoreRequest $formRequest) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::create($request->all());

        \Flash::success('テンプレートを新規登録しました。');

        return redirect()->route('mail');
    }
}
