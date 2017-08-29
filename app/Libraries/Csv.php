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
    public function createReader(string $path, string $open_mode = 'r+')
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
    public function createWriter(string $path, string $open_mode = 'r+')
    {
        $this->Writer = Writer::createFromPath($path);
    }

    /**
     * レコード有無、列数の正当性チェック
     *
     * @param Collection $Collection
     * @param Collection $columns
     * @return bool
     */
    public function isValidColumns(Collection $Collection, Collection $columns)
    {
        if( ! $Collection->count() || count($Collection->first()) !== $columns->count() ) {
            return true;
        }

        return false;
    }

    /**
     * カラム名を割り当てながら取り込み処理を実施
     *
     * @param  Collection $columns
     * @param  Collection $columns
     * @param  bool $isSkip
     * @return Collection
     */
    public function assignColumns(Collection $Collection, Collection $columns, bool $isSkip = false) : Collection
    {
        $result = [];
        foreach ($Collection as $key => $row) {
            if( $key === 0 && $isSkip ) continue;

            $input = [];
            foreach ( $columns as $col ) {
                $value = array_shift($row);
                $input[$col] = mb_convert_encoding($value, 'UTF-8', 'SJIS-win');
            }

            $result[] = $input;
        }

        return collect($result);
    }

    public function getReader() : Reader
    {
        return $this->Reader;
    }

    public function getWriter() : Writer
    {
        return $this->Writer;
    }

}
