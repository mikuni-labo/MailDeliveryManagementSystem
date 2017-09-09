<?php

namespace App\Libraries;

use Illuminate\Support\Collection;
use League\Csv\Reader;
use League\Csv\Writer;

class Csv
{
    /**
     * @var Reader
     */
    private $Reader;

    /**
     * @var Writer
     */
    private $Writer;

    public function __construct()
    {
        //
    }

    /**
     * @param  string $path
     * @param  string $open_mode
     * @return void
     */
    public function createReaderFromPath(string $path, string $open_mode = 'r+')
    {
        $this->Reader = Reader::createFromPath($path, $open_mode);
    }

    /**
     * @param \SplTempFileObject $file
     * @return void
     */
    public function createReaderFromFileObject(\SplTempFileObject $file)
    {
        $this->Reader = Reader::createFromFileObject($file);
    }

    /**
     * @param  string $path
     * @param  string $open_mode
     * @return void
     */
    public function createWriterFromPath(string $path, string $open_mode = 'r+')
    {
        $this->Writer = Writer::createFromPath($path, $open_mode);
    }

    /**
     * @param \SplTempFileObject $file
     * @return void
     */
    public function createWriterFromFileObject(\SplTempFileObject $file)
    {
        $this->Writer = Writer::createFromFileObject($file);
    }

    /**
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

    /**
     * @return Reader
     */
    public function getReader() : Reader
    {
        return $this->Reader;
    }

    /**
     * @return Writer
     */
    public function getWriter() : Writer
    {
        return $this->Writer;
    }

}
