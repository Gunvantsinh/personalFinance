<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Mode;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transcation;
use Illuminate\Http\Request;
use App\Imports\ImportTranscation;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TranscationRepository;
use App\Http\Requests\CreateTranscationRequest;
use App\Http\Requests\UpdateTranscationRequest;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TranscationController extends AppBaseController
{
    /** @var TranscationRepository $transcationRepository*/
    private $transcationRepository;

    public function __construct(TranscationRepository $transcationRepo)
    {
        $this->transcationRepository = $transcationRepo;
    }

    /**
     * Display a listing of the Transcation.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->has('current_month')) {
            $monthYear = date("m-Y", strtotime('0 month', strtotime('01-' . $request->current_month)));
            $next_month = date("m-Y", strtotime('+1 month', strtotime('01-' . $request->current_month)));
            $previous_month = date("m-Y", strtotime('-1 month', strtotime('01-' . $request->current_month)));
        } else {
            $monthYear = Carbon::now()->format('m-Y');
            $next_month = date("m-Y", strtotime('+1 month', strtotime(date('Y-m-d'))));
            $previous_month = date("m-Y", strtotime('-1 month', strtotime(date('Y-m-d'))));
        }
        $data = explode('-', $monthYear);
        $month = $data[0];
        $year = $data[1];
        $transactions = Transcation::LeftJoin('accounts', 'accounts.id', 'transcations.account_id')
            ->select('transcations.*')
            ->whereMonth('date', $month)
            ->where('accounts.is_default', 1)
            ->whereYear('date', $year)
            ->orderBy('date', 'desc')->orderBy('time', 'asc')->paginate(10);
        $total_income = Transcation::whereMonth('date', $month)->whereYear('date', $year)->where('type', 1)
            ->where('created_by', auth()->user()->id)->get()->sum('amount');
        $total_expense = Transcation::whereMonth('date', $month)
            ->whereYear('date', $year)->where('type', 0)->sum('amount');

        $accounts = Account::all();
        // $transcations = $this->transcationRepository->paginate(10);

        return view('transcations.index', compact('transactions', 'monthYear', 'next_month', 'previous_month', 'total_income', 'total_expense', 'accounts'));
    }

    /**
     * Show the form for creating a new Transcation.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $current_month = $request->current_month;
        $accounts = Account::all();
        $categories = Category::all();
        $modes = Mode::all();
        return view('transcations.create', compact('accounts', 'categories', 'modes', 'current_month'));
    }

    /**
     * Store a newly created Transcation in storage.
     *
     * @param CreateTranscationRequest $request
     *
     * @return Response
     */
    public function store(CreateTranscationRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = auth()->user()->id;
        // dd($input);
        $transcation = $this->transcationRepository->create($input);

        Flash::success('Transcation saved successfully.');

        return redirect(route('transcations.index'));
    }

    /**
     * Display the specified Transcation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transcation = $this->transcationRepository->find($id);

        if (empty($transcation)) {
            Flash::error('Transcation not found');

            return redirect(route('transcations.index'));
        }

        return view('transcations.show')->with('transcation', $transcation);
    }

    /**
     * Show the form for editing the specified Transcation.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transcation = $this->transcationRepository->find($id);

        if (empty($transcation)) {
            Flash::error('Transcation not found');

            return redirect(route('transcations.index'));
        }

        $accounts = Account::all();
        $categories = Category::all();
        $modes = Mode::all();
        return view('transcations.edit', compact('transcation', 'accounts', 'categories', 'modes'));
    }

    /**
     * Update the specified Transcation in storage.
     *
     * @param int $id
     * @param UpdateTranscationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTranscationRequest $request)
    {
        $transcation = $this->transcationRepository->find($id);

        if (empty($transcation)) {
            Flash::error('Transcation not found');

            return redirect(route('transcations.index'));
        }

        $transcation = $this->transcationRepository->update($request->all(), $id);

        Flash::success('Transcation updated successfully.');

        return redirect(route('transcations.index'));
    }

    /**
     * Remove the specified Transcation from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transcation = $this->transcationRepository->find($id);

        if (empty($transcation)) {
            Flash::error('Transcation not found');

            return redirect(route('transcations.index'));
        }

        $this->transcationRepository->delete($id);

        Flash::success('Transcation deleted successfully.');

        return redirect(route('transcations.index'));
    }
    public function import(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->transcationFile,
                'extension' => strtolower($request->transcationFile->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:csv,xlsx,xls',
            ]
        );

        if ($validator->fails()) {
            Flash::error($validator->errors()->first());
            return redirect(route('transcations.index'));
        }

        if (strtolower($request->transcationFile->getClientOriginalExtension() == "xls")) {
            // $path = public_path() . '/excel';
            // File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            // $file = $request->transcationFile->getClientOriginalName();
            // $filename = pathinfo($file, PATHINFO_FILENAME);
            // $xlsxFilePath = public_path('excel/' . $filename . '.xlsx');

            // // Load the XLS file
            // $xlsFilePath = $request->file('transcationFile');
            // $path = public_path() . '/excel';
            // File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            // $file = $request->transcationFile->getClientOriginalName();
            // $filename = pathinfo($file, PATHINFO_FILENAME);
            // $xlsxFilePath = public_path('excel/' . $filename . '.xlsx');


            // $spreadsheet = IOFactory::load($xlsFilePath);
            // $xlsxSpreadsheet = new Spreadsheet();
            // $xlsActiveSheet = $spreadsheet->getActiveSheet();

            // // Get the active sheet from the new XLSX spreadsheet
            // $xlsxActiveSheet = $xlsxSpreadsheet->getActiveSheet();
            // foreach ($xlsActiveSheet->getRowIterator() as $row) {
            //     $coordinatesNo = 1;
            //     foreach ($row->getCellIterator() as $cell) {
            //         $coordinates = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
            //         $values = explode("\t", $cell->getValue());
            //         if(count($values)){
            //             dd($values)
            //         }
            //         foreach ($values as $key => $value) {
            //             $coordinate = $coordinates[$key] . $coordinatesNo;
            //             $xlsxActiveSheet->setCellValue($coordinate, $value);
            //         }
            //     }
            //     $coordinatesNo++;
            // }

            // // Create a writer for XLSX format
            // $writer = new Xlsx($xlsxSpreadsheet);

            // // Save the XLSX file
            // $writer->save($xlsxFilePath);
            try {
                Excel::import(new ImportTranscation($request->import_from), $request->file('transcationFile'));
            } catch (\Exception $e) {
                Flash::error($e->getMessage());
                return redirect(route('transcations.index'));
            }
            //unlink($xlsxFilePath);
        } else {
            try {
                Excel::import(new ImportTranscation($request->import_from), $request->file('transcationFile'));
            } catch (\Exception $e) {
                Flash::error($e->getMessage());
                return redirect(route('transcations.index'));
            }
        }

        Flash::success('Transcation Imported successfully.');

        return redirect(route('transcations.index'));
    }
    public function exportCsv()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Transaction.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );

        $reviews = Transcation::orderBy('id', 'DESC')->get();

        $columns = array('Transaction Date', 'Time', 'Category', 'Payment Mode', 'Type', 'Amount', 'Description');
        $callback = function () use ($reviews, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($reviews as $review) {
                $category = Category::withTrashed()->find($review->category_id);
                $category_name = $category ? $category->name : "";
                $mode = Mode::withTrashed()->find($review->mode_id);
                $mode_name = $mode ? $mode->name : "";
                $typename = $review->type == 1 ? 'Income' : 'Expence';
                fputcsv($file, array(date('d-m-Y', strtotime($review->date)), date('H:i', strtotime($review->date)), $category_name, $mode_name, $typename, $review->amount, $review->description));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }
    public function SampleCsv()
    {
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="transactionsample.csv"');

        $output = fopen('php://output', 'w');

        $header = [
            'Transaction Date',
            'Time',
            'Category',
            'Payment Mode',
            'Type',
            'Amount',
            'Description',
        ];
        fputcsv($output, $header, ',');
        $addRecord = [
            '2018-08-03',
            '09:30 AM',
            'Cash',
            'Expence',
            '600',
            'Masiba',
        ];
        fputcsv($output, $addRecord, ',');

        fclose($output);
    }
}
