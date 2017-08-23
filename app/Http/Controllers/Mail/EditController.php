<?php

namespace App\Http\Controllers\Mail;

use App\Http\Requests\Mail\EditRequest;
use App\Models\MailTemplate;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    /** @var EditRequest */
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
     * Show modify form.
     *
     * @method GET
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        dd('here');
        return view('auth.modify')->with([
            'breadcrumb' => $this->setBreadcrumb('Edit', route('mail.edit')),
        ]);
    }

    /**
     * Update
     *
     * @method POST
     * @param EditRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(EditRequest $formRequest)
    {
//         /** @var User $User */
//         $User = auth()->user();
//         $User->update(request()->all());

//         if( isset(request()->password) ) {
//             $User->password = bcrypt(request()->password);
//             $User->save();
//         }

//         \Flash::success('アカウント情報を更新しました。');

//         return redirect()->route('modify');
    }
}
