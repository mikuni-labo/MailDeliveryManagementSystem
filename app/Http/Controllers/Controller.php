<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $breadcrumb = [];

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setBreadcrumb('Home', route('home'));
    }

    /**
     * @return array
     */
    protected function setBreadcrumb($key, $value) : array
    {
        $this->breadcrumb[$key] = $value;
        return $this->breadcrumb;
    }

    /**
     * @return array|string
     */
    protected function getBreadcrumb($key = null)
    {
        if( is_null($key) ) return $this->breadcrumb;

        if( ! array_key_exists($key, $this->breadcrumb) ) return null;

        return $this->breadcrumb[$key];
    }
}
