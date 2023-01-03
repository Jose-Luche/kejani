<?php

namespace App\Http\Controllers\Backend\setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    public function viewFeeCat()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.feeCategory.viewFeeCat', $data);
    }

    public function addFeeCat()
    {
        return view('backend.setup.feeCategory.addFeeCat');
    }

    public function storeFeeCat(Request $request)
    {
        $data = new FeeCategory();
        $data->name = $request->name;
        $data->amount = $request->amount;

        $data->save();

        $notification = array(
            'message' => 'Fee Category added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.cat.view')->with($notification);
    }

    public function editFeeCat($id)
    {
        $data['editData'] = FeeCategory::find($id);
        return view('backend.setup.feeCategory.editFeeCat', $data);
    }

    public function updateFeeCat(Request $request, $id)
    {
        $data = FeeCategory::find($id);
        $data->name = $request->name;
        $data->amount = $request->amount;

        $data->save();

        $notification = array(
            'message' => 'Details updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.cat.view')->with($notification);
    }

    public function deleteFeeCat($id)
    {
        $data = FeeCategory::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Details deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('fee.cat.view')->with($notification);
    }
}
