<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\MailTemplate;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class VisitorsSetController extends Controller
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

        $this->setBreadcrumb('Mail', route('mail'));
    }

    /**
     * Show visitors set list.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return mixed
     */
    public function index(Request $request, int $id, int $setId)
    {
        if( $request->getRequestUri() === "/mail/{$id}/set/{$setId}/visitor" && session()->has("requestUri.mail.set.visitor.list.{$setId}") ) {
            $request->session()->reflash();
            return redirect(session()->pull("requestUri.mail.set.visitor.list.{$setId}"));
        }

        session()->put("requestUri.mail.set.visitor.list.{$setId}", $request->getRequestUri());

        $this->setBreadcrumb('Delivery Set', route('mail.set', $id));

        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $DeliverySet = DeliverySet::findOrFail($setId);

        return view('mail.set.visitor.index')->with([
            'breadcrumb'   => $this->setBreadcrumb('Visitors', route('mail.set.visitor', [$id, $setId])),
            'MailTemplate' => $MailTemplate,
            'DeliverySet'  => $DeliverySet,
            'result'       => Visitor::search($request)->paginate(),
        ]);
    }

    /**
     * Reset requirements of search.
     *
     * @method GET
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return RedirectResponse
     */
    public function reset(Request $request, int $id, int $setId) : RedirectResponse
    {
        /** @var MailTemplate $MailTemplate */
        $MailTemplate = MailTemplate::findOrFail($id);
        $DeliverySet = DeliverySet::findOrFail($setId);

        session()->forget("requestUri.mail.set.visitor.list.{$setId}");

        return redirect()->route('mail.set.visitor', [$id, $setId]);
    }

    /**
     * Change visitor set on Ajax.
     *
     * @method PUT
     * @param Request $request
     * @param integer $id
     * @param integer $setId
     * @return JsonResponse
     */
    public function ajax(Request $request, int $id, int $setId) : JsonResponse
    {
        $result = true;
        $message = "";

        if( ! $request->ajax()  ) {
            $result = false;
            $message = 'Access only ajax.';
        }

        $MailTemplate = MailTemplate::find($id);
        $DeliverySet = DeliverySet::find($setId);

        if( ! $MailTemplate || ! $DeliverySet) {
            $result = false;
            $message = 'Resource Not Found.';
        }

        if( $result ) {
            $visitors = $DeliverySet->data;

            if( (bool)$request->value ) {
                if( in_array(intval($request->visitorId), $visitors) ) {
                    $DeliverySet->data = array_flatten(array_diff($visitors, [intval($request->visitorId)]));
                }
            } else {
                if( ! in_array(intval($request->visitorId), $visitors) ) {
                    array_push($visitors, intval($request->visitorId));
                    $DeliverySet->data = $visitors;
                }
            }

            $message = $DeliverySet->save() ? 'Success!' : 'Failed.';
        }

        return response()->json([
            'result'  => $result,
            'message' => $message,
        ]);
    }

}
