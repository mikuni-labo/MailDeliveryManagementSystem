<?php

namespace App\Services\Csv;

use Illuminate\Validation\Validator;

Interface CsvServiceInterface
{
    public function proccess() : Validator;
}
