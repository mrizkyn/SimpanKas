<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Receivable;
use App\Models\ReceivableRepaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceivablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivableOn = Receivable::all();
        $receivableRepaids = ReceivableRepaid::all();
        $receivables = $receivableOn->concat($receivableRepaids)->sortByDesc('created_at');
        $accounts = Account::all();
        
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
         'debt_recipient' => 'required|string', 
         'receive_nominal' => 'required|integer',
         'payment_date' => 'required|date',
         'receive_desc' => 'required|string',
         'date' => 'required|date',
        ]);

        $r = new Receivable();
        $r->account_id = $request->input('account_id');
        $r->debt_recipient = $request->input('debt_recipient');
        $r->receive_nominal = $request->input('receive_nominal');
        $r->payment_date = $request->input('payment_date');
        $r->receive_desc = $request->input('receive_desc');
        $r->date = $request->input('date');
        $r->noted_by = Auth::user()->name;
        $r->save();
        $request->session()->flash('success', 'Data Berhasil Disimpan'); 
        return redirect('/receivables');

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
        $r = Receivable::find($id);

        if (!$r) {
            return redirect('/receivables');        }
    
        if ($r->status === true) {
            return redirect('/receivables');
        }
    
        $r->status = true;
        $r->save();
    
        $receivableRepaid = new ReceivableRepaid();
        $receivableRepaid->account_id = $r->account_id;
        $receivableRepaid->debt_recipient = $r->debt_recipient;
        $receivableRepaid->receive_nominal = $r->receive_nominal;
        $receivableRepaid->payment_date = $r->payment_date;
        $receivableRepaid->receive_desc = $r->receive_desc;
        $receivableRepaid->date = $r->date;
        $receivableRepaid->status = true; 
        $r->noted_by = Auth::user()->name;
        $receivableRepaid->save();
   
        $r->delete();
    
        return redirect('/receivables');
    }

    }
