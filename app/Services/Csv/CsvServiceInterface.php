<?php

namespace App\Services\Csv;

use Illuminate\Support\Collection;

/**
 * CSVサービス インターフェース
 *
 * @author Kuniyasu Wada
 */
Interface CsvServiceInterface
{
    public function getCollection(string $path) : Collection;
    public function isValid(Collection $collection) : bool;
    public function proccess(Collection $collection);
}
