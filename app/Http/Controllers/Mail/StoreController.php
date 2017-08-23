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
        dd('here');
        return view('auth.modify')->with([
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
