<?php

namespace App\Mail;

use App\Models\DeliverySet;
use App\Models\MailTemplate;
use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryMailable extends Mailable
{
    use Queueable, SerializesModels;

    /** @var MailTemplate */
    private $MailTemplate;

    /** @var DeliverySet */
    private $DeliverySet;

    /** @var Visitor */
    private $Visitor;

    /**
     * Create a new message instance.
     *
     * @param MailTemplate $MailTemplate
     * @param DeliverySet $DeliverySet
     * @param Visitor $Visitor
     * @return void
     */
    public function __construct(MailTemplate $MailTemplate, DeliverySet $DeliverySet, Visitor $Visitor)
    {
        $this->MailTemplate = $MailTemplate;
        $this->DeliverySet  = $DeliverySet;
        $this->Visitor      = $Visitor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->Visitor->email, $this->Visitor->name)
            ->from(config('mail.from.address'), config('mail.from.name'))// TODO fromの設定方法を決める
            ->subject($this->MailTemplate->subject)
            ->text('emails.blank', [
                'content' => $this->replaceContent(),
            ]);
    }

    /**
     * Replace the content.
     *
     * @return string
     */
    private function replaceContent()
    {
        $str = $this->MailTemplate->content;

        /**
         * TODO ここで置換処理
         */

        return $str;
    }

    /**
     * @return MailTemplate
     */
    public function getMailTemplate() : MailTemplate
    {
        return $this->MailTemplate;
    }

    /**
     * @return DeliverySet
     */
    public function getDeliverySet() : DeliverySet
    {
        return $this->DeliverySet;
    }

    /**
     * @return Visitor
     */
    public function getVisitor() : Visitor
    {
        return $this->Visitor;
    }

}
