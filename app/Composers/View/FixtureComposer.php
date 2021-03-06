<?php

namespace App\Composers\View;

use Illuminate\Contracts\View\View;

class FixtureComposer
{
    /**
     * @var array
     */
    protected $fixture;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fixture = config('fixture');
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('FixtureComposer', $this->fixture);
    }

}
