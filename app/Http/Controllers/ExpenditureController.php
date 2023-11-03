<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $a = Account::whereIn('id', [1, 5])->orderBy('id', 'desc')->get();

        // $expenditures = Expenditure::with('Account');
        return view('Manager.Expenditure.index', compact('expenditures','accounts','a'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function getChild(Request $request)
     {
         $parent_id = $request->input('parent_id');
         $childAccounts = Account::where('parent_id', $parent_id)->whereIn('parent_id', [1, 5, 6])->get();
         return response()->json($childAccounts);
     }
 
     public function getSub(Request $request)
     {
         $parent_id = $request->input('parent_id');
         $subAccounts = Account::where('parent_id', $parent_id)->whereIn('parent_id', [6])->get();
         return response()->json($subAccounts);
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
            'date' => 'required|date',
            'account_id' => 'required',
            'exp_desc' => 'required|string',
            'nominal_exp' => 'required|integer',
         
        ]);
    
        $annualDep = $request->input('annual_dep');
        $depMonth = $request->input('dep_month');


        $exp = new Expenditure();
        $exp->date = $request->input('date');
        $exp->account_id = $request->input('account_id');
        $exp->exp_desc = (string)$request->input('exp_desc');
        $exp->nominal_exp = (integer)$request->input('nominal_exp');
        $exp->asset_period = (integer)$request->input('asset_period');
        $exp->dep_month = (integer)$request->input('dep_month');
        $exp->annual_dep = (integer)$request->input('annual_dep');
        $exp->noted_by = Auth::user()->name;
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
        $request->validate([
            'edit_exp_name' => 'required',
        ]);
        $exp = Expenditure::findOrFail($id);
        $exp->nominal_exp = $request->input('edit_exp_name');
        $exp->save();
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
