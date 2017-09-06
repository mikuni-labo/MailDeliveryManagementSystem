<?php

namespace App\Mail;

use App\Models\MailTemplate;
use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryMailable extends Mailable implements MailableInterface
{
    use Queueable, SerializesModels;

    /** @var MailTemplate */
    private $MailTemplate;

    /** @var Visitor */
    private $Visitor;

    /**
     * Create a new message instance.
     *
     * @param MailTemplate $MailTemplate
     * @param Visitor $Visitor
     * @return void
     */
    public function __construct(MailTemplate $MailTemplate, Visitor $Visitor)
    {
        $this->MailTemplate = $MailTemplate;
        $this->Visitor = $Visitor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        dd($this->MailTemplate);
        dd($this->Visitor);

        return $this->view('emails.test');
    }
}
