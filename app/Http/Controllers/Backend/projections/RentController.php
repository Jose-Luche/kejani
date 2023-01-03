<?php

namespace App\Http\Controllers\Backend\projections;

use App\Models\Unit;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\RentProjection;
use App\Http\Controllers\Controller;

class RentController extends Controller
{
    public function viewRent()
    {
        $data['allData'] = RentProjection::all();
        return view('backend.account.rent.viewRent', $data);
    }

    public function addRent()
    {
        $data['units'] = Unit::all();
        $data['branches'] = Branch::all();

        return view('backend.account.rent.addRent', $data);
    }

    public function getRent(Request $request)
    {
        $branch_id = $request->branch_id;
        $date = date('Y-m', strtotime($request->date));

        $data = Tenant::where('branch_id', $branch_id)->get();

        $html['thsource'] = '<th>Name</th>';
        $html['thsource'] .= '<th>House Number</th>';
        $html['thsource'] .= '<th>Amount</th>';
        $html['thsource'] .= '<th>Amount Due</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $v) {
            $rent = Unit::where('branch_id', $branch_id)->first();
            $tenantrent = RentProjection::where('tenant_id', $v->tenant_id)->where('branch_id', $v->branch_id)->where('date', $date)->first();

            if ($tenantrent != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }


            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . $v->name . '<input
            type="hidden" name="branch_id" value=" ' . $branch_id . ' ">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . $v->unit->name . '</td>';


            $html[$key]['tdsource'] .= '<td>' . $rent->rent . '<input
            type="hidden" name="date" value=" ' . $date . ' ">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . '<input
            type="text" name="amount[]" value=" ' . $rent->rent . ' " class="form-control" >' . '</td>';



            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="tenant_id[]" 
            value=" ' . $v->id . '">' . '<input type="checkbox" name="checkmanage[]"
            id="' . $key . '" value="' . $key . '" ' . $checked . ' style="transform:scale(1.5);margin-left:10px;"> <label for="' . $key . '">
            </label> ' . '</td>';
        }
        return response()->json(@$html);
    }

    public function storeRent(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));
        RentProjection::where('branch_id', $request->branch_id)->where('date', $request->date)->delete();

        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i = 0; $i < count($checkdata); $i++) {
                $data = new RentProjection();
                $data->branch_id = $request->branch_id;
                $data->date = $date;
                $data->tenant_id = $request->tenant_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];

                $data->save();
            }
        }

        if (!empty(@$data) || empty($checkdata)) {

            $notification = array(
                'message' => 'Done! Data Added successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('rent.view')->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry! Data not saved',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
