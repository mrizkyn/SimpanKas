<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Account;
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
        $debts = Debt::all();
        $accounts = Account::all();
        $debts = Debt::with('Account')->paginate(5);
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
        return redirect('/debt');

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

    public function toggleStatus($id)
{
    $debt = Debt::findOrFail($id);
    $debt->status = $debt->status === 'lunas' ? 'belum lunas' : 'lunas';
    $debt->save();

    return redirect()->back()->with('success', 'Status successfully updated.');
}

}
