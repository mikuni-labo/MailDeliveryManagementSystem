<?php

namespace App\Observers;

use App\Models\Visitor;

class VisitorObserver
{
    /**
     * Listening event on updated.
     *
     * @param  Visitor $Visitor
     * @return void
     */
    public function updated(Visitor $Visitor)
    {
        if( ! $Visitor->possible_delivery_flag || $Visitor->failed_delivery_flag ) {
            $Visitor->deliverySetVisitors()->forceDelete();
        }
    }

    /**
     * Listening event on deleting.
     *
     * @param  Visitor $Visitor
     * @return void
     */
    public function deleting(Visitor $Visitor)
    {
        $Visitor->deliverySetVisitors()->forceDelete();
    }

}
