<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class StatementController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // ...
    
    public function index(Request $request)
    {
        $startMonth = null;
        $endMonth = null;
        $totalPendapatan = 0;
        $totalBebanOperasional = 0;
        $totalBebanUtilitas = 0;
        $totalBeban = 0;
        $totalHPP = 0;
        $labaKotor = 0;
        $labaBersih = 0;
    
        if ($request->isMethod('post')) {
            $startMonth = $request->input('start_month');
            $endMonth = $request->input('end_month');
    
            $totalPendapatan = DB::table('incomes')
                ->whereBetween('date', [$startMonth, $endMonth])
                ->sum('total');
    
            $totalBebanOperasional = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startMonth, $endMonth])
                ->where('accounts.parent_id')
                ->sum('expenditures.nominal_exp');
    
            $totalBebanUtilitas = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startMonth, $endMonth])
                ->where('accounts.account_name', 'Beban Utilitas')
                ->sum('expenditures.nominal_exp');
    
            $totalBeban = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startMonth, $endMonth])
                ->where('accounts.parent_id', 5)
                ->sum('expenditures.nominal_exp');
    
            $totalHPP =  $totalBeban - ($totalBebanOperasional + $totalBebanUtilitas);
    
            $labaKotor = $totalPendapatan - $totalHPP;
    
            $labaBersih = $labaKotor - $totalBeban;

            
        }
    
        $parent_id = 5;
        $bebans = Expenditure::with('account')
            ->where('date', '>=', date($startMonth))
            ->where('date', '<=', date($endMonth))
            ->whereHas('account', function ($parent) use ($parent_id) {
                $parent->where('parent_id', $parent_id);
            })->orderBy('account_id')->get();

            $incomes = DB::table('incomes')
            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(incomes.total) as total_inc'))
            ->whereBetween('incomes.date', [$startMonth, $endMonth])
            ->where('accounts.parent_id', 5)
            ->groupBy('accounts.account_name')
            ->get();

            $accumulatedData = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereBetween('expenditures.date', [$startMonth, $endMonth])
            ->where('accounts.parent_id', )
            ->groupBy('accounts.account_name')
            ->get();
    

        return view('Report.Statement.index', compact('incomes','accumulatedData','bebans','startMonth', 'endMonth', 'totalPendapatan', 'totalBebanOperasional', 'totalBebanUtilitas', 'totalBeban', 'totalHPP', 'labaKotor', 'labaBersih'));
    }
    
    



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
