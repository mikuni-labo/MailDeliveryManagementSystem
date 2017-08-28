<?php

namespace App\Http\Controllers\Mail;

use App\Models\MailTemplate;
use App\Http\Controllers\Controller;

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
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::onlyTrashed()->findOrFail($id);
        $MailTemplate->restore();

        \Flash::success('テンプレートを1件復旧しました。');
        return redirect()->route('mail');
    }

}
