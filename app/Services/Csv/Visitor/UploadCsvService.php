<?php

namespace App\Services\Csv\Visitor;

use App\Http\Requests\Visitor\StoreRequest;
use App\Libraries\Csv;
use App\Models\Visitor;
use App\Services\Csv\CsvServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UploadCsvService implements CsvServiceInterface
{
    /**
     * @var Csv
     */
    private $Csv;

    /**
     * @var Collection
     */
    private $columns;

    /**
     * @var Collection
     */
    private $Collection;

    /**
     * @var boolean
     */
    private $skipHeader = true;

    /**
     * @var object
     */
    private $file;

    /**
     * @var StoreRequest
     */
    private $visitorRequest;

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
        $this->visitorRequest = new StoreRequest;
    }

    /**
     * {@inheritDoc}
     * @see \App\Services\Csv\CsvServiceInterface::proccess()
     */
    public function proccess() : Validator
    {
        $this->Collection = $this->getCollection($this->file->getRealPath());

        /**
         * @var \Illuminate\Validation\Validator $result
         */
        $result = $this->makeValidColumns($this->Collection);

        if( $result->fails() ) {
            return $result;
        }

        $this->Collection = $this->Csv->assignColumns($this->Collection, $this->columns, $this->skipHeader);

        /**
         * @var \Illuminate\Validation\Validator $result
         */
        $result = $this->makeValidParams($this->Collection);

        if( $result->fails() ) {
            return $result;
        }

        /**
         * @var \Illuminate\Validation\Validator $result
         */
        $result = $this->makeValidUniqueEmail($this->Collection);

        if( $result->fails() ) {
            return $result;
        }

        $this->createVisitors($this->Collection);

        return $result;
    }

    /**
     * アップロードファイルのデータを取得してコレクションを返す
     *
     * @param string $path
     * @return Collection
     */
    private function getCollection(string $path) : Collection
    {
        $this->Csv->createReaderFromPath($path);
        $this->Csv->getReader()->setDelimiter(',');
        $this->Csv->getReader()->setNewline("\r\n");

        return collect($this->Csv->getReader()->fetchAll());
    }

    /**
     * 取り込み処理前の行・列簡易バリデート
     *
     * @param Collection $Collection
     * @return Validator
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
     * 厳密な値の配列バリデート
     *
     * @param Collection $Collection
     * @return Validator
     */
    private function makeValidParams(Collection $Collection) : Validator
    {
        return \Validator::make(
            $Collection->toArray(),
            [
                '*.name'                   => $this->visitorRequest->rules()['name'],
                '*.organization'           => $this->visitorRequest->rules()['organization'],
                '*.department'             => $this->visitorRequest->rules()['department'],
                '*.position'               => $this->visitorRequest->rules()['position'],
                '*.postcode'               => $this->visitorRequest->rules()['postcode'],
                '*.address'                => $this->visitorRequest->rules()['address'],
                '*.email'                  => $this->visitorRequest->rules()['email'],
                '*.tel'                    => $this->visitorRequest->rules()['tel'],
                '*.fax'                    => $this->visitorRequest->rules()['fax'],
                '*.possible_delivery_flag' => $this->visitorRequest->rules()['possible_delivery_flag'],
                '*.exhibitor_type'         => $this->visitorRequest->rules()['exhibitor_type'],
                '*.enterprise_type'        => $this->visitorRequest->rules()['enterprise_type'],
            ],
            [
                //
            ],
            $this->getVisitorAttributes()
        );
    }

    /**
     * データ内メールアドレス重複チェック
     *
     * @param Collection $Collection
     * @return Validator
     */
    private function makeValidUniqueEmail(Collection $Collection) : Validator
    {
        return \Validator::make(
            [
                'unique_email' => $Collection->count() === $Collection->uniqueStrict('email')->count(),
            ],
            [
                'unique_email' => 'true',
            ],
            [
                'unique_email.true' => 'メールアドレスが重複しています。'
            ],
            [
                //
            ]
            );
    }

    /**
     * 来場者属性を取得して配列バリデート用に加工
     *
     * @return array
     */
    private function getVisitorAttributes() : array
    {
        foreach ($this->visitorRequest->attributes() as $key => $val) {
            $arr["*.$key"] = $val;
            unset($arr[$key]);
        }

        return $arr;
    }

    /**
     * 来場者登録
     *
     * @param Collection $Collection
     * @return void
     */
    private function createVisitors(Collection $Collection)
    {
        foreach ( $Collection as $values ) {
            Visitor::create($values);
        }
    }


    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

}
