<?php

namespace App\Services\Csv\Visitor;

use Illuminate\Support\Collection;
use App\Libraries\Csv;
use App\Services\Csv\CsvServiceInterface;
use Illuminate\Validation\Validator;

/**
 * 来場者CSVアップロードサービス
 *
 * @author Kuniyasu Wada
 */
class UploadCsvService implements CsvServiceInterface
{
    private $csv;
    private $columns;
    private $result;

    const CSV_COLUMNS = [
        'pos_bill_code',
        'test1',
        'test2',
    ];

    /**
     * Create a new class instance.
     *
     * @param Csv $Csv
     * @return void
     */
    public function __construct(Csv $Csv)
    {
        $this->csv = $Csv;
        $this->columns = collect(self::CSV_COLUMNS);
    }

    /**
     * {@inheritDoc}
     * @see \App\Services\Csv\CsvServiceInterface::getCollection()
     */
    public function getCollection(string $path) : Collection
    {
        $this->csv->createReader($path);
        $this->csv->getReader()->setDelimiter(',');

        return collect($this->csv->getReader()->fetchAll());
    }

    /**
     * {@inheritDoc}
     * @see \App\Services\Csv\CsvServiceInterface::isValid()
     */
    public function isValid(Collection $collection) : Validator
    {
        return \Validator::make(
            [
                'valid_comuns' => $this->csv->isValidColumns($collection, $this->columns),
            ],
            [
                'valid_comuns' => 'required|false',
            ],
            [
                //
            ],
            [
                //
            ]);
    }

    /**
     * {@inheritDoc}
     * @see \App\Services\Csv\CsvServiceInterface::proccess()
     */
    public function proccess(Collection $collection)
    {
        if( ! $this->csv->validate() )
        {
            \Flash::error('ファイル内にレコードが無いか、列の数が合いません。');
            return redirect()->back();
        }

        $result = $this->assignColumns(self::CSV_COLUMNS, true);
        $csv = $result->groupBy('pos_bill_code');

        /**
         * 通貨毎ループ
         */
//         foreach ( Currency::all() as $Currency )
//         {
//             $price  = 0;
//             $amount = 0;

//             foreach ( $Currency->bills()->get() as $Bill )
//             {
//                 if( $csv->has($Bill->pos_code) )
//                 {
//                     $price  += intval( $csv->get($Bill->pos_code)->first()['stock_price'] );               // 期末在庫金額
//                     $amount += intval( $csv->get($Bill->pos_code)->first()['stock_amount']) * $Bill->value;// 額面合計 = 期末在庫数 * 紙幣の額面
//                 }
//             }

//             $Currency->update([
//                     'cost' => $this->culculateCost($price, $amount),
//             ]);
//         }
    }

}
