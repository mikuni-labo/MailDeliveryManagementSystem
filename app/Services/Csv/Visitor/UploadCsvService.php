<?php

namespace App\Services\Csv\Visitor;

use App\Http\Requests\Visitor\EditRequest;
use App\Libraries\Csv;
use App\Models\Visitor;
use App\Services\Csv\CsvServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * 来場者CSVアップロードサービス
 *
 * @author Kuniyasu Wada
 */
class UploadCsvService implements CsvServiceInterface
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
    public function proccess($file) : Validator
    {
        $this->Collection = $this->getCollection($file->getRealPath());

        /**
         * 取り込み処理前の行・列簡易バリデート
         *
         * @var \Illuminate\Validation\Validator $result
         */
//         $result = $this->makeValidColumns($this->Collection);

//         if( $result->fails() ) {
//             return $result;
//         }

        $this->Collection = $this->Csv->assignColumns($this->Collection, $this->columns, $this->skipHeader);

        /**
         * 厳密な値バリデート
         */
        $result = $this->makeValidParams($this->Collection);

        $this->getVisitorAttributes();

        if( $result->fails() ) {
            return $result;
        }

        /**
         * TODO DB登録処理
         */
    }

    /**
     *
     */
    private function getCollection(string $path) : Collection
    {
        $this->Csv->createReader($path);
        $this->Csv->getReader()->setDelimiter(',');

        return collect($this->Csv->getReader()->fetchAll());
    }

    /**
     *
     */
    private function makeValidColumns(Collection $Collection) : Validator
    {
        return \Validator::make(
            [
                'valid_comuns' => $this->Csv->isValidColumns($Collection, $this->columns),
            ],
            [
                'valid_comuns' => 'false',
            ],
            [
                'valid_comuns.false' => 'アップロードされたファイルの列数が合わないか、データが不正です。',
            ],
            [
                //
            ]
        );
    }

    /**
     *
     */
    private function makeValidParams(Collection $Collection) : Validator
    {
        return \Validator::make(
            $Collection->toArray(),
            [
                '*.name'         => 'nullable',
                '*.organization' => 'nullable',
                '*.department'   => 'nullable',
                '*.position'     => 'nullable',
                '*.postcode'     => 'nullable',
                '*.address'      => 'nullable',
                '*.email'        => 'required|string|email|max:255|unique:visitors',
                '*.tel'          => 'nullable',
                '*.fax'          => 'nullable',
            ],
            [
                //
            ],
            $this->getVisitorAttributes()
        );
    }

    /**
     *
     * @return array
     */
    private function getVisitorAttributes() : array
    {
        $arr = ((new EditRequest)->attributes());

        foreach ($arr as $key => $val) {
            $arr["*.$key"] = $val;
            unset($arr[$key]);
        }

        return $arr;
    }

}
