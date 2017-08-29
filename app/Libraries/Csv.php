<?php

namespace App\Libraries;

use Illuminate\Support\Collection;
use League\Csv\Reader;
use League\Csv\Writer;

/**
 * CSVライブラリ操作クラス
 *
 * @author Kuniyasu Wada
 */
class Csv
{
    private $Reader;
    private $Writer;

    public function __construct()
    {
        //
    }

    /**
     * Readerインスタンスをセット
     *
     * @param  string $path
     * @param  string $open_mode
     * @return void
     */
    public function createReader($path, $open_mode = 'r+')
    {
        $this->Reader = Reader::createFromPath($path);
    }

    /**
     * Writerインスタンスをセット
     *
     * @param  string $path
     * @param  string $open_mode
     * @return void
     */
    public function createWriter($path, $open_mode = 'r+')
    {
        $this->Writer = Writer::createFromPath($path);
    }

    /**
     * レコード有無、列数の正当性チェック
     *
     * @param Collection $collection
     * @param Collection $columns
     * @return bool
     */
    public function isValidColumns(Collection $collection, Collection $columns)
    {
        if( ! $collection->count() || count($collection->first()) !== $columns->count() ) {
            return true;
        }

        return false;
    }

    /**
     * カラム名を割り当てながら取り込み処理を実施
     *
     * @param  array $columns
     * @param  bool $isSkip
     * @return Collection
     */
    public function assignColumns($columns, $isSkip = false)
    {
        $result = [];
        foreach ($this->csv as $key => $row)
        {
            // インデックス行はスキップ
            if( $key === 0 && $isSkip ) continue;

            $input = [];
            foreach ( $columns as $col )
            {
                $value = array_shift($row);
                $input[$col] = mb_convert_encoding($value, 'UTF-8', 'SJIS-win');
            }

            $result[] = $input;
        }

        return collect($result);
    }

    /**
     * Setter...
     */
//     public function setCsv($csv)
//     {
//         $this->csv = $csv;
//         return $this;
//     }

    /**
     * Getter...
     */
    public function getReader()
    {
        return $this->Reader;
    }

    public function getWriter()
    {
        return $this->Writer;
    }

    public function getCsv()
    {
        return $this->csv;
    }

}
