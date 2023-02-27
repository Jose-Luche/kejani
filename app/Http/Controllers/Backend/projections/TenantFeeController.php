<?php

namespace App\Http\Controllers\Backend\projections;

use App\Models\Unit;
use App\Models\Projection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\FeeAmount;
use App\Models\FeeCategory;
use App\Models\Tenant;
use App\Models\unitcategory;

class TenantFeeController extends Controller
{
    public function viewTenFee()
    {
        $data['allData'] = Projection::all();
        return view('backend.account.tenantFee.viewFee', $data);
    }

    public function addTenFee()
    {
        $data['unitCategories'] = unitcategory::all();
        $data['fee_categories'] = FeeCategory::all();
        $data['branches'] = Branch::all();

        return view('backend.account.tenantFee.addFee', $data);
    }

    public function getTenFee(Request $request)
    {
        $branch_id = $request->branch_id;
        //$unit_category_id = $request->unit_category_id;
        $type = $request->type;
        
        $fee_category_id = $request->fee_category_id;
        //if ($type == "rent") {
        //$fee_category_id = null;
        //}
        $date = date('Y-m', strtotime($request->date));

        $data = Tenant::where('branch_id', $branch_id)->get();

        $html['thsource'] = '<th>ID No</th>';
        $html['thsource'] .= '<th>Name</th>';
        $html['thsource'] .= '<th>House Number</th>';
        $html['thsource'] .= '<th>Amount</th>';
        $html['thsource'] .= '<th>Amount Due</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $v) {
            if ($type == "other") {
                $regfee = FeeAmount::where('fee_category_id', $fee_category_id)->where('branch_id', $branch_id)->first();
                $tenantfees = Projection::where('tenant_id', $v->tenant_id)->where('branch_id', $v->branch_id)->where('type', $type)->where('fee_category_id', $fee_category_id)
                    ->where('date', $date)->first();
            } else {
                $regfee = Unit::where('id', $v->unit_id)->where('branch_id', $branch_id)->first();
                $tenantfees = Projection::where('tenant_id', $v->tenant_id)->where('branch_id', $v->branch_id)->where('type', $type)
                    ->where('date', $date)->first();
            }




            if ($tenantfees != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            //dd($tenantfees);

            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . $v->id_no . '<input
            type="hidden" name="fee_category_id" value=" ' . $fee_category_id . ' ">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $v->name . '<input
            type="hidden" name="branch_id" value=" ' . $branch_id . ' ">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $v->unit->name . '<input
            type="hidden" name="type" value=" ' . $type . ' ">' . '</td>';



            if ($type == "other") {
                $html[$key]['tdsource'] .= '<td>' . $regfee->amount . '<input
                type="hidden" name="date" value=" ' . $date . ' ">' . '</td>';

                $html[$key]['tdsource'] .= '<td>' . '<input
                type="text" name="amount[]" value=" ' . $regfee->amount . ' " class="form-control" >' . '</td>';
                

            } else {
                $html[$key]['tdsource'] .= '<td>' . $regfee->rent . '<input
                type="hidden" name="date" value=" ' . $date . ' ">' . '</td>';

                $html[$key]['tdsource'] .= '<td>' . '<input
                type="text" name="amount[]" value=" ' . $regfee->rent . ' " class="form-control" readonly >' . '</td>';
            }




            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="tenant_id[]" 
            value=" ' . $v->id . '">' . '<input type="checkbox" name="checkmanage[]"
            id="' . $key . '" value="' . $key . '" ' . $checked . ' style="transform:scale(1.5);margin-left:10px;"> <label for="' . $key . '">
            </label> ' . '</td>';
        }
        return response()->json(@$html);
    }

    public function storeTenFee(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));
        Projection::where('branch_id', $request->branch_id)->where('fee_category_id', $request->fee_category_id)->where('date', $request->date)->delete();

        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i = 0; $i < count($checkdata); $i++) {
                $data = new Projection();
                $data->branch_id = $request->branch_id;
                $data->type = $request->type;
                $data->fee_category_id = $request->fee_category_id;
                $data->date = $date;
                $data->tenant_id = $request->tenant_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];

                $data->save();
            }
        }

        if (!empty(@$data) || empty($checkdata)) {

            $notification = array(
                'message' => 'Done! Data Inserted successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tenant.fee.view')->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry! Data not saved',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
