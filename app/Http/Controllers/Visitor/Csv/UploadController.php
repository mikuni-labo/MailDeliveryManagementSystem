<?php

namespace App\Http\Controllers\Visitor\Csv;

use App\Models\Visitor;
use App\Http\Requests\Visitor\Csv\UploadRequest;
use App\Http\Controllers\Controller;
use App\Services\Csv\CsvServiceInterface;

class UploadController extends Controller
{
    private $csvService;

    /**
     * Create a new controller instance.
     *
     * @param CsvServiceInterface $CsvServiceInterface
     * @return void
     */
    public function __construct(CsvServiceInterface $CsvServiceInterface)
    {
        $this->middleware('auth');

        parent::__construct();

        $this->csvService = $CsvServiceInterface;
    }

    /**
     * Upload visitors CSV.
     *
     * @method POST
     * @param UploadRequest $UploadRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(UploadRequest $UploadRequest)
    {
        dd( $this->csvService );


// 		\Flash::error('店舗レートCSVの取り込みに失敗しました。');

// 		if(request()->hasFile('store_rate_csv'))
// 		{
// 			$CsvServiceInterface->createReader( request()->file('store_rate_csv')->getRealPath() );
// 			$CsvServiceInterface->getReader()->setDelimiter(',');
// 			$CsvServiceInterface->setCsv( $CsvServiceInterface->getReader()->fetchAll() );

// 			if( ! $CsvServiceInterface->validate() )
// 			{
// 				\Flash::error('ファイル内にレコードが無いか、列の数が合いません。');
// 				return redirect()->back();
// 			}

// 			$CsvServiceInterface->proccess();

// 			\Flash::success('店舗レートCSVを取り込みました。');
// 		}

// 		return redirect()->route('admin.csv.store_rate');
    }

}
