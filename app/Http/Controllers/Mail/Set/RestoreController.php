<?php

namespace App\Http\Controllers\Mail\Set;

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
     * Restore a template.
     *
     * @method PATCH
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function restore(Request $request, int $id) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::onlyTrashed()->findOrFail($id);
        $MailTemplate->restore();

        \Flash::success('テンプレートを1件復旧しました。');

        return redirect()->route('mail');
    }

}
