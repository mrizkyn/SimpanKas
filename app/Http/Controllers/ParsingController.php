<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class ParsingController extends Controller
{

    //Account
    public function getChildAccounts(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $childAccounts = Account::where('parent_id', $parent_id)->where('code_name','like','%0')->get();
        return response()->json($childAccounts);
    }
    public function checkCode(Request $request)
    {
        $code = $request->input('code');
        $exists = Account::where('code_name', $code)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function getChild(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $childAccounts = Account::where('parent_id', $parent_id)->whereIn('parent_id', [1,5,6,7,8,9,10])->get();
        return response()->json($childAccounts);
    }



}
