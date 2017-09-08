<?php

namespace App\Observers;

use App\Models\MailTemplate;

class MailTemplateObserver
{
    /**
     * Listening event on deleting.
     *
     * @param  MailTemplate $MailTemplate
     * @return void
     */
    public function deleting(MailTemplate $MailTemplate)
    {
        $MailTemplate->deliverySets()->delete();
    }

}
