<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Unit;
use App\Models\unitcategory;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function viewUnit()
    {
        $data['allData'] = Unit::all();
        return view('backend.setup.unit.viewUnit', $data);
    }

    public function addUnit()
    {
        $data['categories'] = unitcategory::all();
        $data['branches'] = Branch::all();
        return view('backend.setup.unit.addUnit', $data);
    }

    public function storeUnit(Request $request)
    {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->cat_id = $request->cat_id;
        $unit->branch_id = $request->branch_id;
        $unit->rent = $request->rent;

        $unit->save();

        $notification = array(
            'message' => 'Unit Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.view')->with($notification);
    }

    public function editUnit($id)
    {
        $data['categories'] = unitcategory::all();
        $data['branches'] = Branch::all();
        $data['editData'] = Unit::find($id);
        return view('backend.setup.unit.editUnit', $data);
    }

    public function updateUnit(Request $request, $id)
    {
        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->cat_id = $request->cat_id;
        $unit->branch_id = $request->branch_id;
        $unit->rent = $request->rent;

        $unit->save();

        $notification = array(
            'message' => 'Details updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.view')->with($notification);
    }

    public function deleteUnit($id)
    {
        $data = Unit::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Unit Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('unit.view')->with($notification);
    }
}
