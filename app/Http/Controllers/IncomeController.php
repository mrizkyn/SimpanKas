<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Account;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::orderBy('date','desc')->get();
        $accounts = Account::all();
        // $incomes = Income::with('Account');
        return view('Manager.Income.index', compact('incomes','accounts'));
        
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
        $accounts = Account::all();

        $validatedData = $request->validate([
         'account_id' => 'required',
         'descrription' => 'required', 
         'total' => 'required',
         'date' => 'required',
        ]);

        $income = new Income();
        $income->account_id = $request->input('account_id');
        $income->descrription = $request->input('descrription');
        $income->total = $request->input('total');
        $income->date = $request->input('date');
        $income->noted_by = Auth::user()->name;

        $income->save();

        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/income');


        
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
        $request->validate([
            'edit_income_name' => 'required',
        ]);
        $income = Income::findOrFail($id);
        $income->total = $request->input('edit_income_name');
        $income->save();
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui');
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
