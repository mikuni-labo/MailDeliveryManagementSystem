<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function index(Request $request, int $id) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $MailTemplate->delete();

        \Flash::info('テンプレートを1件削除しました。');
        return redirect()->route('mail');
    }

}
