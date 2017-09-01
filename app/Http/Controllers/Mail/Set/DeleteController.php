<?php

namespace App\Http\Controllers\Mail\Set;

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
     * Delete a template.
     *
     * @method DELETE
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function delete(Request $request, int $id) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $MailTemplate->delete();

        \Flash::info('テンプレートを1件削除しました。');
        return redirect()->route('mail');
    }

}
