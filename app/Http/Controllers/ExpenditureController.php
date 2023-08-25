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
        $a = Account::whereIn('id', [1, 5])->get();
        // $expenditures = Expenditure::with('Account');
        return view('Manager.Expenditure.index', compact('expenditures','accounts','a'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function getChildAccounts(Request $request)
     {
         $parent_id = $request->input('parent_id');
         $childAccounts = Account::where('parent_id', $parent_id)->where('parent_id',[1,5])->get();
         return response()->json($childAccounts);
     }
     public function checkCode(Request $request)
     {
         $code = $request->input('code');
         $exists = Account::where('code_name', $code)->exists();
         return response()->json(['exists' => $exists]);
     }

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
        $validatedData = $request->validate([
            'date' => 'required',
            'account_id' => 'required',
            'exp_desc' => 'required',
            'nominal_exp' => 'required',
        ]);
    
        $exp = new Expenditure();
        $exp->date = $request->input('date');
        $exp->account_id = $request->input('account_id');
        $exp->exp_desc = $request->input('exp_desc');
        $exp->nominal_exp = $request->input('nominal_exp');
        $exp->save();
    
        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/expenditure');
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
