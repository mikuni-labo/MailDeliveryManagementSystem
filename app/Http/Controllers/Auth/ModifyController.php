<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\ModifyRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class ModifyController extends Controller
{
    /** @var ModifyRequest */
    private $formRequest;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show modify form.
     *
     * @method GET
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('auth.modify', [
            'row' => auth()->user(),
        ]);
    }

    /**
     * Update
     *
     * @method POST
     * @param ModifyRequest $formRequest
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(ModifyRequest $formRequest)
    {
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
