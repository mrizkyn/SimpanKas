<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Receivable;
use Illuminate\Http\Request;

class ReceivablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivables = Receivable::all();
        $accounts = Account::all();
        $receivables = Receivable::with('Account')->paginate(5);
        return view('Manager.Receivables.index', compact('receivables','accounts'));
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
         'debt_recipient' => 'required', 
         'receive_nominal' => 'required',
         'payment_date' => 'required',
         'receive_desc' => 'required',
         'date' => 'required',
        ]);

        $r = new Receivable();
        $r->account_id = $request->input('account_id');
        $r->debt_recipient = $request->input('debt_recipient');
        $r->receive_nominal = $request->input('receive_nominal');
        $r->payment_date = $request->input('payment_date');
        $r->receive_desc = $request->input('receive_desc');
        $r->date = $request->input('date');
        $r->save();

        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/Receivables');

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
        $r = Receivable::findOrFail($id);
        $r->status = $r->status === 'lunas' ? 'belum lunas' : 'lunas';
        $r->save();
    
        return redirect()->back()->with('success', 'Status successfully updated.');
    }
}
