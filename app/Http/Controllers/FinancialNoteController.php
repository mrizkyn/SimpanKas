<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expenditure;
use Illuminate\Support\Facades\DB;

class FinancialNoteController extends Controller
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
        $totalPeralatan = 0;
        $totalPerlengkapan = 0;
        $totalBebanUtilitas = 0;
        $totalBeban = 0;
        $totalHPP = 0;
        $labaKotor = 0;
        $labaBersih = 0;
        $totalAsetLancar = 0;
        $totalAsetTetap = 0;
        $akumPenyusutanPeralatan = 0;
        $asetTetap = 0;
        $akumPenyusutanBangunan = 0;
        $akumAsetTetap = 0;
        $akumulasiOverhead = 0;
        $totalAset = 0;
        $totalUtang = 0;
        $modal = 0;
        $totalLiabilitasdanEkuitas = 0;
        
    
        if ($request->isMethod('post')) {
            $selectedYear = $request->input('selected_year');
            
            $startDate = date("Y-m-d", strtotime("Januari 1, $selectedYear"));
            $endDate = date("Y-m-d", strtotime("Desember 31, $selectedYear"));
    
            $totalPendapatan = DB::table('incomes')
                ->whereYear('date', [$selectedYear])
                ->sum('total');

            
    
            $totalUtang = DB::table('debts')
                ->join('accounts', 'debts.account_id', '=', 'accounts.id')
                ->whereYear('debts.date', [$selectedYear])
                ->where('accounts.parent_id', [2])
                ->sum('debts.debt_nominal');
    
            $totalBebanOperasional = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 8)
                ->sum('expenditures.nominal_exp');
    
            $totalOverheadPabrik = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 9)
                ->sum('expenditures.nominal_exp');
    
            $totalTenagaKerja = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 10)
                ->sum('expenditures.nominal_exp');
    
            $totalBeban = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->whereIn('accounts.parent_id', [8, 9, 10])
                ->sum('expenditures.nominal_exp');

            $totalPerlengkapan = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 6)
                ->sum('expenditures.nominal_exp');

                $asetTetap = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_nominal'))
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 7)
                ->where('accounts.account_name', '<>', 'Peralatan')
                ->groupBy('accounts.account_name')
                ->get();

                $akumAsetTetap = DB::table('expenditures')
                ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
                ->whereYear('expenditures.date', [$selectedYear])
                ->where('accounts.parent_id', 7)
                ->where('accounts.account_name', '<>', 'Peralatan')
                ->sum('expenditures.nominal_exp');


            $totalPiutang = DB::table('receivables')
                ->join('accounts', 'receivables.account_id', '=', 'accounts.id')
                ->whereYear('receivables.date', [$selectedYear])
                ->whereIn('accounts.parent_id', [3])
                ->sum('receivables.receive_nominal');
    
            $totalHPP =  $totalBeban;
    
            $labaKotor = $totalPendapatan - $totalHPP;
    
            $labaBersih = $labaKotor - $totalBeban;
            
            $totalAsetTetap = $totalPeralatan + $akumAsetTetap - $akumPenyusutanBangunan - $akumPenyusutanPeralatan;

            $totalAsetLancar = $totalPiutang + $totalPerlengkapan + $labaBersih;

            $totalAset = $totalAsetLancar + $totalAsetTetap;

            $modal = $totalAset - $totalUtang;

            $totalLiabilitasdanEkuitas = $modal + $totalUtang;
        }


            $totalPeralatan = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.account_name', 'Peralatan')
            ->sum('expenditures.nominal_exp');

            $akumPenyusutanPeralatan = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.account_name', 'Peralatan')
            ->sum('expenditures.annual_dep');

            $akumPenyusutanBangunan = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.account_name', 'Rumah')
            ->sum('expenditures.annual_dep');

            $totalPiutang = DB::table('receivables')
            ->join('accounts', 'receivables.account_id', '=', 'accounts.id')
            ->whereYear('receivables.date', [$selectedYear])
            ->whereIn('accounts.parent_id', [3])
            ->sum('receivables.receive_nominal');

            $incomes = DB::table('incomes')
            ->join('accounts', 'incomes.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(incomes.total) as total_inc'))
            ->whereYear('incomes.date', [$selectedYear])
            ->where('accounts.parent_id', 4)
            ->groupBy('accounts.account_name')
            ->get();
    
            $akumulasiOperasional = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.parent_id', 8)
            ->groupBy('accounts.account_name')
            ->get();

            $akumulasiPerlengkapan = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_perlengkapan'))
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.parent_id', 6)
            ->groupBy('accounts.account_name')
            ->get();

            $akumulasiPiutang = DB::table('receivables')
            ->join('accounts', 'receivables.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(receivables.receive_nominal) as total_piutang'))
            ->whereYear('receivables.date', [$selectedYear])
            ->where('accounts.parent_id', 3)
            ->groupBy('accounts.account_name')
            ->get();
    
            $akumulasiTenagaKerja = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.parent_id', 9)
            ->groupBy('accounts.account_name')
            ->get();

            $akumulasiOverhead = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->select('accounts.account_name', DB::raw('SUM(expenditures.nominal_exp) as total_exp'))
            ->whereYear('expenditures.date', [$selectedYear])
            ->where('accounts.parent_id', 10)
            ->groupBy('accounts.account_name')
            ->get();
        return view('Report.financialnote.index', compact('akumulasiOverhead','totalLiabilitasdanEkuitas','modal','totalUtang','totalAset','totalAsetTetap','akumPenyusutanBangunan','asetTetap','akumPenyusutanPeralatan','totalPiutang','totalPerlengkapan','totalPeralatan','akumulasiPerlengkapan','akumulasiTenagaKerja','akumulasiOperasional','incomes','selectedYear', 'totalPendapatan', 'totalBebanOperasional', 'totalBebanUtilitas', 'totalBeban', 'totalHPP', 'labaKotor', 'labaBersih', 'akumulasiPiutang','totalAsetLancar'));
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
