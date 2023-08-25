<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


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
        if ($request->ajax()) {
            $startMonth = $request->input('start_month');
            $endMonth = $request->input('end_month');
    
            $totalPendapatan = DB::table('incomes')
            ->whereBetween('date', [$startMonth, $endMonth])
            ->sum('total');

            $totalBebanOperasional = DB::table('expenditures')
            ->join('accounts', 'expenditures.account_id', '=', 'accounts.id')
            ->whereBetween('expenditures.date', [$startMonth, $endMonth])
            ->where('accounts.account_name', 'Beban Operasional')
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
   
            return new JsonResponse([
                'totalPendapatan' => $totalPendapatan,
                'totalHPP' => $totalHPP,
                'totalBeban' => $totalBeban,
                'labaKotor' => $labaKotor,
                'labaBersih' => $labaBersih,
            ]);
        }

        $parent_id = 5;
        $beban = Expenditure::with('account')
        ->whereHas('account', function ($query) use ($parent_id) {
        $query->where('parent_id', $parent_id);
    })
         ->get();
    
        return view('Report.Statement.index', compact('beban'));
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
