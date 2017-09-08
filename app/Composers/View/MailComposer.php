<?php

namespace App\Composers\View;

use Illuminate\Contracts\View\View;

class MailComposer
{
    /**
     * @var array
     */
    protected $mail;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mail = config('mail');
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('MailComposer', $this->mail);
    }

}
