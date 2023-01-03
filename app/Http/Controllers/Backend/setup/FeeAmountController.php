<?php

namespace App\Http\Controllers\Backend\setup;

use App\Models\Branch;
use App\Models\FeeAmount;
use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeAmountController extends Controller
{
    public function viewAmount()
    {
        $data['allData'] = FeeAmount::all();
        //$data['allData'] = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.feeAmount.viewFeeAmount', $data);
    }

    public function addAmount()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['branches'] = Branch::all();
        return view('backend.setup.feeAmount.addFeeAmount', $data);
    }

    public function storeAmount(Request $request)
    {
        //count($request->branch_id);
        //count((is_countable($request->branch_id)?$request->branch_id:[]))
        $countBranch = count((is_countable($request->branch_id) ? $request->branch_id : []));
        if ($countBranch != NULL) {
            for ($i = 0; $i < $countBranch; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->branch_id = $request->branch_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
            }
        }

        $notification = array(
            'message' => 'Details Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function editAmount($id)
    {
        $data['editData'] = FeeAmount::where('fee_category_id', $id)->get();

        $data['fee_categories'] = FeeCategory::all();
        $data['branches'] = Branch::all();
        return view('backend.setup.feeAmount.editFeeAmount', $data);
    }

    public function upAmount(Request $request, $id)
    {
        if ($request->branch_id == NULL) {
            $notification = array(
                'message' => 'No Amount added',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.edit', $id)->with($notification);
        } else {
            $countBranch = count((is_countable($request->branch_id) ? $request->branch_id : []));
            FeeAmount::where('fee_category_id', $id)->delete();
            for ($i = 0; $i < $countBranch; $i++) {
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->branch_id = $request->branch_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
            }


            $notification = array(
                'message' => 'Data Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('fee.amount.view')->with($notification);
        }
    }
}
