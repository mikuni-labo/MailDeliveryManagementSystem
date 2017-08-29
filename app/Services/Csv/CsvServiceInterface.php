<?php

namespace App\Services\Csv;

use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * CSVサービス インターフェース
 *
 * @author Kuniyasu Wada
 */
Interface CsvServiceInterface
{
    public function getCollection(string $path) : Collection;

    public function isValid(Collection $collection) : Validator;

    public function proccess(Collection $collection);
}
