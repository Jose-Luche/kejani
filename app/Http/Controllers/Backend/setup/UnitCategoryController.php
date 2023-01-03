<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\unitcategory;
use Illuminate\Http\Request;

class UnitCategoryController extends Controller
{
    public function viewCat()
    {
        $data['allData'] = unitcategory::all();
        return view('backend.setup.unitcat.viewCat', $data);
    }

    public function addCat()
    {
        return view('backend.setup.unitcat.addCat');
    }

    public function storeCat(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:unitcategories,name',

        ]);

        $data = new unitcategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.cat.view')->with($notification);
    }

    public function editCat($id)
    {
        $editData = unitcategory::find($id);
        return view('backend.setup.unitcat.editCat', compact('editData'));
    }

    public function updateCat(Request $request, $id)
    {
        $data = unitcategory::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:unitcategories,name,' . $data->id

        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.cat.view')->with($notification);
    }

    public function deleteCat($id)
    {
        $class = unitcategory::find($id);
        $class->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('unit.cat.view')->with($notification);
    }
}
