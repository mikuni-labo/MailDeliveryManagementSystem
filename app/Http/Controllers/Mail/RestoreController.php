<?php

namespace App\Http\Controllers\Mail;

use App\Models\MailTemplate;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, int $id)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::onlyTrashed()->findOrFail($id);
        $MailTemplate->restore();

        \Flash::success('テンプレートを1件復旧しました。');
        return redirect()->route('mail');
    }

}
