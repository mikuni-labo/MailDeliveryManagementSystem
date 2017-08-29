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
        if( request()->hasFile('upload_csv') ) {

            $result = $this->csvService->getCollection(request()->file('upload_csv')->getRealPath());
            $r = $this->csvService->isValid($result);
            dd($r);

            $this->csvService->proccess($result);

            \Flash::success('');
        }

        return redirect()->route('visitor.csv');
    }

}
