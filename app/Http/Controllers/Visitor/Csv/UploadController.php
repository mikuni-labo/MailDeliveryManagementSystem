<?php

namespace App\Http\Controllers\Visitor\Csv;

use App\Http\Controllers\Controller;
use App\Http\Requests\Visitor\Csv\UploadRequest;
use App\Services\Csv\CsvServiceInterface;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @param UploadRequest $UploadRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, UploadRequest $UploadRequest)
    {
        if( $request->hasFile('upload_csv') ) {

            $this->csvService->setFile($request->file('upload_csv'));
            $result = $this->csvService->proccess();

            if( $result->fails() ){
                return redirect()->back()->withErrors($result);
            }

            \Flash::success('アップロード成功しました。');
        }

        return redirect()->route('visitor.csv');
    }

}
