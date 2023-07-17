<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditures = Expenditure::all();
        $accounts = Account::all();
        $expenditures = Expenditure::with('Account')->paginate(5);
        return view('Manager.Expenditure.index', compact('expenditures','accounts'));
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
         'category_exp' => 'required', 
         'nominal_exp' => 'required',
         'exp_desc' => 'required',
         'date' => 'required',
        ]);

        $exp = new Expenditure();
        $exp->account_id = $request->input('account_id');
        $exp->category_exp = $request->input('category_exp');
        $exp->nominal_exp = $request->input('nominal_exp');
        $exp->exp_desc = $request->input('exp_desc');
        $exp->date = $request->input('date');
        $exp->save();

        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/Expenditure');
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
