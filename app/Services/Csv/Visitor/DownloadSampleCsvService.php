<?php

namespace App\Services\Csv\Visitor;

use App\Http\Requests\Visitor\EditRequest;
use App\Libraries\Csv;
use App\Services\Csv\CsvServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

class DownloadSampleCsvService implements CsvServiceInterface
{
    private $Csv;
    private $columns;
    private $Collection;
    private $skipHeader = true;

    const CSV_COLUMNS = [
        'name',
        'organization',
        'department',
        'position',
        'postcode',
        'address',
        'email',
        'tel',
        'fax',
        'possible_delivery_flag',
        'exhibitor_type',
        'enterprise_type',
    ];

    /**
     * Create a new class instance.
     *
     * @param Csv $Csv
     * @return void
     */
    public function __construct(Csv $Csv)
    {
        $this->Csv = $Csv;
        $this->columns = collect(self::CSV_COLUMNS);
    }

    /**
     * {@inheritDoc}
     * @see \App\Services\Csv\CsvServiceInterface::proccess()
     */
    public function proccess() : Validator
    {
        $attributes = (new EditRequest)->attributes();

        $headers = [];
        foreach ( $this->columns as $val ) {
            $col = array_key_exists($val, $attributes) ? $attributes[$val] : '該当無し';
            array_push($headers, mb_convert_encoding($col, 'SJIS-win', 'UTF-8'));// ヘッダー生成用
        }

        $this->Csv->createWriterFromFileObject(new \SplTempFileObject());
        $this->Csv->getWriter()->setDelimiter(',');
        $this->Csv->getWriter()->setNewline("\r\n");
        $this->Csv->getWriter()->insertOne($headers);

        return \Validator::make([], [], [], []);
    }

    public function download() : Response
    {
        return \Response::make($this->Csv->getWriter()->__toString(), 200, [
            'Content-Type' => 'text/csv; charset=Shift_JIS',
            'Content-Disposition' => "attachment; filename=visitor_sample.csv",
        ]);
    }

}
