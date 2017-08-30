<?php

namespace App\Http\Controllers\Visitor\Csv;

use App\Http\Controllers\Controller;
use App\Services\Csv\CsvServiceInterface;

class DownloadSampleController extends Controller
{
    private $csvService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CsvServiceInterface $CsvServiceInterface)
    {
        $this->middleware('auth');

        parent::__construct();

        $this->csvService = $CsvServiceInterface;
    }

    /**
     * Download sample CSV.
     *
     * @method GET
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        if( ! $this->csvService->proccess()->fails() ) {
            return $this->csvService->download();
        }

        \Flash::error('CSVダウンロード時にエラーが発生しました。');
        return redirect()->route('visitor.csv');
    }

}
