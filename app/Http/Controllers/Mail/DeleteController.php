<?php

namespace App\Http\Controllers\Mail;

use App\Models\MailTemplate;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
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
     * @method DELETE
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $MailTemplate->delete();

        \Flash::info('テンプレートを1件削除しました。');
        return redirect()->route('mail');
    }

}
