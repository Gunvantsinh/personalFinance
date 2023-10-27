<?php

namespace App\Imports;

use App\Models\Account;
use Flash;
use App\Models\Mode;
use App\Models\Category;
use App\Models\Transcation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportTranscation implements ToModel, WithStartRow
{
    private $import_from;

    public function __construct(string $import_from)
    {
        $this->import_from = $import_from;
    }

    public function model(array $row)
    {
        if ($this->import_from == 'sbi' || $this->import_from == 'State Bank of India' || $this->import_from == 'SBI' || $this->import_from == 'State Bank') {
            if ($row[0] != null && $row[1] != null && $row[2] != null && trim(strtolower($row[4])) != 'debit' && trim(strtolower($row[5])) != 'credit' && ($row[4] != "" ?? $row[5]  != "")) {
                $unix_date = ($row[0] - 25569) * 86400;
                $excel_date = 25569 + ($unix_date / 86400);
                $final_date = ($excel_date - 25569) * 86400;
                $transcation_date =  gmdate("Y-m-d", $final_date);
                $transcation_type = trim($row[4]) == "" ? '1' : '0';
                $amount = trim($row[4]) == "" ? $row[5] : $row[4];

                $account = Account::where('name', 'like', '%' . $this->import_from . '%')->first();
                if ($account) {
                    $account_id = $account->id;
                } else {
                    $account = Account::where('is_default', 1)->first();
                    if ($account) {
                        $account_id = $account->id;
                    } else {
                        $account_id = NULL;
                    }
                }
                if (str_contains($row[2], 'UPI')) {
                    $mode = Mode::where("name", "LIKE", 'Phonepe')->first();
                    if ($mode) {
                        $mode_id = $mode->id;
                    }
                } else {
                    $mode = Mode::where("name", "LIKE", 'ATM')->first();
                    $mode_id = $mode->id;
                }
                $category = Category::where("name", "LIKE", 'Transfer')->first();

                if ($category) {
                    $category_id = $category->id;
                } else {
                    $category_id = "";
                }
                $transcation = Transcation::where('type', $transcation_type)
                    ->where('type', $transcation_type)
                    ->where('amount', $amount)
                    ->where('category_id', $category_id)
                    ->where('mode_id', $mode_id)
                    ->where('date', $transcation_date)
                    ->first();
                if (!$transcation) {
                    return new Transcation([
                        'created_by'  => auth()->user()->id,
                        'type'    => $transcation_type,
                        'amount' => $amount,
                        'account_id' => $account_id,
                        'category_id' => $category_id,
                        'mode_id' => $mode_id,
                        'date' => $transcation_date,
                        'description' => $row[2],
                    ]);
                }
            }
        } else if ($this->import_from == 'own_format') {
            if ($row[0] != null && $row[5] != null && is_numeric($row[5])) {
                $date1 = strtr($row[0], '/', '-');
                $date = date('Y-m-d', strtotime($date1));
                $category = Category::where("name", "LIKE", $row[2])->first();

                if ($category) {
                    $category_id = $category->id;
                } else {
                    $Category = new Category;
                    $Category->name = $row[2];
                    $Category->save();
                    $category_id = $Category->id;
                }

                $mode = Mode::where("name", "LIKE", $row[3])->first();
                if ($mode) {
                    $mode_id = $mode->id;
                } else {
                    $mode = new Mode;
                    $mode->name = $row[3];
                    $mode->save();
                    $mode_id = $mode->id;
                }
                $account = Account::where('is_default', 1)->first();
                if ($account) {
                    $account_id = $account->id;
                } else {
                    $account_id = NULL;
                }
                return new Transcation([
                    'created_by'  => auth()->user()->id,
                    'type'    => $row[4] == "Expense" ? 0 : 1,
                    'amount' => $row[5],
                    'account_id' => $account_id,
                    'category_id' => $category_id,
                    'mode_id' => $mode_id,
                    'date' => $date,
                    'description' => $row[6],
                ]);
            }
        } else {
            Flash::error('Transcation method not found!');

            return redirect(route('transcations.index'));
        }
    }
    public function startRow(): int
    {
        return 1;
    }
}
