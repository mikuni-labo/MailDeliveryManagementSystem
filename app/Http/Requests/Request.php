<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    protected $id;
//     protected $prefix = '';

    public function setId($id)
    {
        $this->id = $id;
    }

//     public function setPrefix($prefix)
//     {
//         $this->prefix = $prefix;
//     }

}
