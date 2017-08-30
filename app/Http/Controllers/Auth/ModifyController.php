<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ModifyRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ModifyController extends Controller
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
     * Show modify form.
     *
     * @method GET
     * @return View
     */
    public function index() : View
    {
        $this->setBreadcrumb('Modify', route('modify'));

        return view('auth.modify')->with([
            'row' => auth()->user(),
            'breadcrumb' => $this->getBreadcrumb(),
        ]);
    }

    /**
     * Update
     *
     * @method PUT
     * @param ModifyRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(ModifyRequest $formRequest)
    {
        /** @var User $User */
        $User = auth()->user();
        $User->update(request()->all());

        if( isset(request()->password) ) {
            $User->password = bcrypt(request()->password);
            $User->save();
        }

        \Flash::success('アカウント情報を更新しました。');

        return redirect()->route('modify');
    }
}
