<?php

namespace App\Observers;

use App\Models\Visitor;

class VisitorObserver
{
    /**
     * Listening event of deleting.
     *
     * @param  Visitor $Visitor
     * @return void
     */
    public function deleting(Visitor $Visitor)
    {
        $Visitor->deliverySetVisitors()->forceDelete();
    }

}
