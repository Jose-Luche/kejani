<?php

namespace App\Http\Controllers\Backend\accounts;

use App\Models\Ledger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgerController extends Controller
{
    public function viewLedger()
    {
        $data['allData'] = Ledger::all();
        return view('backend.account.ledgers.viewLedger', $data);
    }

    public function addLedger()
    {
        return view('backend.account.ledgers.addLedger');
    }

    public function storeLedger(Request $request)
    {
        $ledger = new Ledger();
        $ledger->accType = $request->accType;
        $ledger->accSubType = $request->accSubType;
        $ledger->accName = $request->accName;
        $ledger->accNo = $request->accNo;
        $ledger->narration = $request->narration;
        $ledger->openBalance = $request->openBalance;
        $ledger->regDate = date('Y-m-d', strtotime($request->regDate));

        $ledger->save();

        $notification = array(
            'message' => 'Account Created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('ledger.view')->with($notification);
    }
}
