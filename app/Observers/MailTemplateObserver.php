<?php

namespace App\Observers;

use App\Models\MailTemplate;

class MailTemplateObserver
{
    /**
     * テンプレート削除イベントのリッスン
     *
     * @param  MailTemplate $MailTemplate
     * @return void
     */
    public function deleting(MailTemplate $MailTemplate)
    {
        $MailTemplate->deliverySets()->delete();
    }

}
