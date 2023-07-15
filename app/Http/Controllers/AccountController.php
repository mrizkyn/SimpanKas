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
        $accounts = Account::all();
        $accounts = Account::paginate(5);
        return view('Manager.Account.index', compact('accounts'));
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
            'code_name' => 'required',
            'account_name' => 'required',
        ]);
    
        // Memastikan nilai 'code_name' dan 'account_name' ada sebelum menyimpan data
        $account = new Account();
        $account->code_name = $request->input('code_name');
        $account->account_name = $request->input('account_name');
        $account->save();

        $request->session()->flash('success', 'Data Berhasil Disimpan');
        return redirect('/Account');
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
        $account = Account::findOrFail($id);
        $account->code_name = $request->input('edit_code_name');
        $account->account_name = $request->input('edit_account_name');
        $account->save();

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);

        // Hapus data akun
        $account->delete();
    
        // Setelah menghapus, kembali ke halaman '/Account' dengan pesan flash
        return redirect('/Account')->with('success', 'Data berhasil dihapus');
    }
}
