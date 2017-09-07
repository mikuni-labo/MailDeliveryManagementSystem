<?php

namespace App\Http\Controllers\Mail\Set;

use App\Http\Controllers\Controller;
use App\Models\DeliverySet;
use App\Models\DeliverySetVisitor;
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

        if( ! $request->has('visitorId') || ! $request->has('value')) {
            $result = false;
            $message = 'The parameter of visitorId and value are reqired.';
        }

        $MailTemplate = MailTemplate::find($id);
        $DeliverySet = DeliverySet::find($setId);
        $Visitor = Visitor::find($request->visitorId);

        if( ! $MailTemplate || ! $DeliverySet || ! $Visitor) {
            $result = false;
            $message = 'Resource Not Found.';
        }

        if( $result ) {

            /** @var DeliverySetVisitor $DeliverySetVisitor */
            $DeliverySetVisitor = $Visitor->deliverySetVisitors()->where('delivery_set_id', '=', $setId)->first();

            if( (bool)$request->value ) {
                if( ! is_null($DeliverySetVisitor) ) {
                    $DeliverySetVisitor->forceDelete();
                    $message = 'Deleted.';
                }
            } else {
                if( is_null($DeliverySetVisitor) ) {
                    $DeliverySetVisitor = DeliverySetVisitor::create([
                        'mail_template_id' => $id,
                        'delivery_set_id'  => $setId,
                        'visitor_id'       => $request->visitorId,
                    ]);

                    $message = $DeliverySetVisitor->toJson();
                }
            }
        }

        return response()->json([
            'result'  => $result,
            'message' => $message,
        ]);
    }

}
