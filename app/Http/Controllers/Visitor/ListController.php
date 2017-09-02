<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
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

        $this->setBreadcrumb('Visitor', route('visitor'));
    }

    /**
     * Show visitors list.
     *
     * @method GET
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request)
    {
        if( $request->getRequestUri() === '/visitor' && session()->has('requestUri.visitor.list') ) {
            $request->session()->reflash();
            return redirect(session()->pull('requestUri.visitor.list'));
        }

        session()->put('requestUri.visitor.list', $request->getRequestUri());

        return view('visitor.index')->with([
            'breadcrumb' => $this->getBreadcrumb(),
            'result'    => Visitor::search($request)->paginate(),
        ]);
    }

    /**
     * Reset requirements of search.
     *
     * @method GET
     * @param Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request) : RedirectResponse
    {
        session()->forget('requestUri.visitor.list');

        return redirect()->route('visitor');
    }

}
