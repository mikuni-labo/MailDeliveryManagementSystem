<?php

namespace App\Http\Controllers\Visitor\Csv;

use App\Models\Visitor;
use App\Http\Controllers\Controller;

class UploadController extends Controller
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
     * Upload visitors CSV.
     *
     * @method POST
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload()
    {
        dd('here');

        /** @var Visitor $Visitor */
        $Visitor = Visitor::findOrFail($id);
        $Visitor->update(request()->all());

        \Flash::success('来場者情報を更新しました。');

        return redirect()->route('visitor');
    }

}
