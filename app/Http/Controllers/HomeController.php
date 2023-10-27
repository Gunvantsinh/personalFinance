<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Category;
use Carbon\CarbonPeriod;
use App\Models\Transcation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //dd($request->all());
        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            $start_of_month_for_picker = Carbon::parse($request->start_date)->format('m/d/Y');
            $end_of_month_for_picker = Carbon::parse($request->end_date)->format('m/d/Y');
            
           
            $totalIncome = Transcation::LeftJoin('accounts','accounts.id','transcations.account_id')->whereBetween('date', [$start_date,$end_date])->where('type',1)
            ->where('accounts.is_default',1)
            ->where('transcations.created_by',auth()->user()->id)->get()->sum('amount');

            $totalExpence = Transcation::LeftJoin('accounts','accounts.id','transcations.account_id')->whereBetween('date',[$start_date,$end_date])->where('type',0)
            ->where('transcations.created_by',auth()->user()->id)
            ->where('accounts.is_default',1)
            ->get()->sum('amount');
                
        }else{

            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $all_tran = Transcation::all()->whereBetween('date', [$start_date, $end_date]);
        
            $year_arr = date('Y');
            $fn_month = date('m');

            $start_of_month_for_picker = Carbon::now()->startOfMonth()->format('m/d/Y');
            $end_of_month_for_picker = Carbon::now()->endOfMonth()->format('m/d/Y');
            
            $date_range_arr = [date("Y-m-d", strtotime($year_arr . "-" . $fn_month . "-01")),
            date("Y-m-d", strtotime($year_arr + 1 . "-" . $fn_month . "-01 - 1 day"))];

            $totalIncome = Transcation::LeftJoin('accounts','accounts.id','transcations.account_id')->whereBetween('date', $date_range_arr)
            ->where('type',1)
            ->where('accounts.is_default',1)
            ->where('transcations.created_by',auth()->user()->id)->get()->sum('amount');

            $totalExpence = Transcation::LeftJoin('accounts','accounts.id','transcations.account_id')->whereBetween('date', $date_range_arr)->where('type',0)
            ->where('transcations.created_by',auth()->user()->id)
            ->where('accounts.is_default',1)
            ->get()->sum('amount');

        }
            $availableBalance = $totalIncome - $totalExpence;
            $avlBalance = $availableBalance > 0 ?  $availableBalance : 0; 
            $monthlyReportArr = [$totalIncome,$totalExpence,$avlBalance]; 
            

           
        return view('home', compact('totalIncome', 'totalExpence', 'availableBalance','monthlyReportArr','start_of_month_for_picker','end_of_month_for_picker'));
    }
}
