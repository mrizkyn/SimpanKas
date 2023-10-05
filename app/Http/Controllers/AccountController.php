<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::orderBy('code_name','asc')->get();
        $a = Account::where('parent_id', null)->orderBy('code_name', 'asc')->get();
      
        return view('Manager.Account.index', compact('accounts','a'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
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
        'code_name' => 'required|unique:accounts',
        'account_name' => 'required',
        'parent_id' => 'nullable|exists:accounts,id',
        'child_account' => 'nullable|exists:accounts,id',
        'parent_account' => 'nullable|exists:accounts,id',
        
    ]);
        
        $account = new Account;
        $account->parent_id = $request->input('parent_id');
        $account->code_name = $request->input('code_name');
        $account->account_name = $request->input('account_name');
        if (!empty($validatedData['child_account']) && $validatedData['child_account'] != 'non_select_sub') {
            $childAccount = Account::find($validatedData['child_account']);
            $account->parent_id = $childAccount->id;
        } elseif (!empty($validatedData['child_account'])) {
            $parent_account = Account::find($validatedData['parent_account']);
            $account->parent_id = $parent_account->id;
        }
            
        $account->save();

        return redirect()->route('accounts.index')->with('Data Berhasil Disimpan');
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
            'edit_account_name' => 'required|string|max:255',
        ]);
        $account = Account::findOrFail($id);
        $account->account_name = $request->input('edit_account_name');
        $account->save();
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
        // $account = Account::findOrFail($id);

        // // Hapus data akun
        // $account->delete();
    
        // // Setelah menghapus, kembali ke halaman '/Account' dengan pesan flash
        // return redirect('/Account')->with('success', 'Data berhasil dihapus');
    }

// ... (kode lain pada controller)

 



}
