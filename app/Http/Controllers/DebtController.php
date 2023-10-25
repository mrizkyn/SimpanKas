<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Account;
use App\Models\DebtRepaid;
use DB;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtOn = Debt::all();
        $debtRepaids = DebtRepaid::all();
        $debts = $debtOn->concat($debtRepaids);
        $accounts = Account::all();
      
        return view('Manager.Debt.index', compact('debts','accounts'));
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
         'creditor' => 'required', 
         'debt_nominal' => 'required',
         'due_date' => 'required',
         'debt_desc' => 'required',
         'date' => 'required',
        ]);

        $debt = new Debt();
        $debt->account_id = $request->input('account_id');
        $debt->creditor = $request->input('creditor');
        $debt->debt_nominal = $request->input('debt_nominal');
        $debt->due_date = $request->input('due_date');
        $debt->debt_desc = $request->input('debt_desc');
        $debt->date = $request->input('date');
        $debt->save();

        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/account');
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

    public function changeStatusToPaid($id)
    {
        $debt = Debt::find($id);

        if (!$debt) {
            return redirect('/debt');        }
    
        if ($debt->status === true) {
            return redirect('/debt');
        }
    
        $debt->status = true;
        $debt->save();
    
        $debtRepaid = new DebtRepaid();
        $debtRepaid->account_id = $debt->account_id;
        $debtRepaid->creditor = $debt->creditor;
        $debtRepaid->debt_nominal = $debt->debt_nominal;
        $debtRepaid->due_date = $debt->due_date;
        $debtRepaid->debt_desc = $debt->debt_desc;
        $debtRepaid->date = $debt->date;
        $debtRepaid->status = true; 
        $debtRepaid->save();
   
        $debt->delete();
    
        return redirect('/debt');    
    }
    
    }    


