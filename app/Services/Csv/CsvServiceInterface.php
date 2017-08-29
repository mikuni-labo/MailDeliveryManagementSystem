<?php

namespace App\Services\Csv;

use Illuminate\Validation\Validator;

/**
 * CSVサービス インターフェース
 *
 * @author Kuniyasu Wada
 */
Interface CsvServiceInterface
{
    public function proccess($file) : Validator;
}
