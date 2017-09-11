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

    /**
     * @var MailTemplate
     */
    private $MailTemplate;

    /**
     * @var DeliverySet
     */
    private $DeliverySet;

    /**
     * @var Visitor
     */
    private $Visitor;

    /**
     * @var array
     */
    private $templateTags;

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

        $this->templateTags = config('mail.template_tags');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->Visitor->email)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($this->MailTemplate->subject)
            ->text('emails.blank', [
                'content' => $this->replaceContent($this->MailTemplate->content, $this->Visitor),
            ]);
    }

    /**
     * Replace the content from template tags.
     *
     * @param string $content
     * @param Visitor $Visitor
     * @return string
     */
    private function replaceContent(string $content, Visitor $Visitor)
    {
        if( count($this->templateTags) ) {
            foreach ($this->templateTags as $key => $val) {
                if( !empty($Visitor->{$key}) ) {
                    $content = str_replace("[##{$key}##]", $Visitor->{$key}, $content);
                }
            }
        }

        return $content;
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
