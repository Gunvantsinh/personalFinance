<?php

namespace App\Imports;

use App\Models\Mode;
use App\Models\Category;
use App\Models\Transcation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportTranscation implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[1] != null && $row[2] != null && is_numeric($row[2])){
            $date1 = strtr($row[1], '/', '-');
            $date = date('Y-m-d', strtotime($date1));
            
            $category = Category::where("name","LIKE",$row[4])->first();
            if($category){
                $category_id = $category->id;
            }else{
                $Category = new Category;
                $Category->name = $row[4];
                $Category->save();
                $category_id = $Category->id;
            }

            $mode = Mode::where("name","LIKE",$row[5])->first();
            if($mode){
                $mode_id = $mode->id;
            }else{
                $mode = new Mode;
                $mode->name = $row[4];
                $mode->save();
                $mode_id = $mode->id;
            }
            return new Transcation([
                'created_by'  => auth()->user()->id,
                'type'    => $row[3] == "Expense" ? 0 : 1, 
                'amount' => $row[2],
                'account_id' => 3,//BOB MY personal
                'category_id' => $category_id,
                'mode_id' => $mode_id,
                'date' => $date ,
                'description' => $row[6],
            ]);
        }
    }
    public function startRow(): int
    {
        return 68;
    }
}
