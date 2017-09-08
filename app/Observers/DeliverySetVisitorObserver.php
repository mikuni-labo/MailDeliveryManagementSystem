<?php

namespace App\Observers;

use App\Models\DeliverySetVisitor;

class DeliverySetVisitorObserver
{
    /**
     * Listening event on creating.
     *
     * @param  DeliverySetVisitor $DeliverySetVisitor
     * @return void
     */
    public function creating(DeliverySetVisitor $DeliverySetVisitor)
    {
        if( ! $DeliverySetVisitor->visitor->possible_delivery_flag ) {
            return false;
        }
    }

}
