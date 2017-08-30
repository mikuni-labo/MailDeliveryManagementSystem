<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RestoreController extends Controller
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
    }

    /**
     * Show visitors list.
     *
     * @method PATCH
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function index(Request $request, int $id) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::onlyTrashed()->findOrFail($id);
        $MailTemplate->restore();

        \Flash::success('テンプレートを1件復旧しました。');

        return redirect()->route('mail');
    }

}
