<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FinancialpositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedYear = null;
        $totalPendapatan = 0;
        $totalBebanOperasional = 0;
        $totalBebanUtilitas = 0;
        $totalBeban = 0;
        $totalHPP = 0;
        $labaKotor = 0;
        $labaBersih = 0;
        $startDate = null;
        $endDate = null;
    
        if ($request->isMethod('post')) {
            $selectedYear = $request->input('selected_year');
            
            $startDate = date("Y-m-d", strtotime("January 1, $selectedYear"));
            $endDate = date("Y-m-d", strtotime("December 31, $selectedYear"));
    
            $totalPendapatan = DB::table('incomes')
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('total');
    
            $totalBebanOperasional = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startDate, $endDate])
                ->where('accounts.parent_id', 8)
                ->sum('expenditures.nominal_exp');
    
            $totalOverheadPabrik = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startDate, $endDate])
                ->where('accounts.parent_id', 9)
                ->sum('expenditures.nominal_exp');
    
            $totalTenagaKerja = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startDate, $endDate])
                ->where('accounts.parent_id', 10)
                ->sum('expenditures.nominal_exp');
    
            $totalBeban = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereBetween('expenditures.date', [$startDate, $endDate])
                ->whereIn('accounts.parent_id', [8, 9, 10])
                ->sum('expenditures.nominal_exp');
    
            $totalHPP =  $totalBeban;
    
            $labaKotor = $totalPendapatan - $totalHPP;
    
            $labaBersih = $labaKotor - $totalBeban;
        }
    
        $parent_id = 5;
        $bebans = Expenditure::with('account')
            ->where('date', '>=', date($startDate))
            ->where('date', '<=', date($endDate))
            ->whereHas('account', function ($parent) use ($parent_id) {
                $parent->where('parent_id', $parent_id);
            })->orderBy('account_id')->get();
    
        $incomes = DB::table('incomes')
            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(incomes.total) as total_inc'))
            ->whereBetween('incomes.date', [$startDate, $endDate])
            ->where('accounts.parent_id', 4)
            ->groupBy('accounts.account_name')
            ->get();
    
        $akumulasiOperasional = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereBetween('expenditures.date', [$startDate, $endDate])
            ->where('accounts.parent_id', 8)
            ->groupBy('accounts.account_name')
            ->get();
    
        $akumulasiTenagaKerja = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereBetween('expenditures.date', [$startDate, $endDate])
            ->where('accounts.parent_id', 9)
            ->groupBy('accounts.account_name')
            ->get();
    
        $akumulasiOverhead = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereBetween('expenditures.date', [$startDate, $endDate])
            ->where('accounts.parent_id', 10)
            ->groupBy('accounts.account_name')
            ->get();
    
        return view('Report.financialposition.index', compact('akumulasiOverhead','akumulasiTenagaKerja','akumulasiOperasional','incomes','bebans','selectedYear', 'totalPendapatan', 'totalBebanOperasional', 'totalBebanUtilitas', 'totalBeban', 'totalHPP', 'labaKotor', 'labaBersih'));
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
