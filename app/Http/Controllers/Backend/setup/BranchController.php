<?php

namespace App\Http\Controllers\Backend\setup;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function viewBranch()
    {
        $data['allData'] = Branch::all();
        return view('backend.setup.branch.viewBranch', $data);
    }

    public function addBranch()
    {
        return view('backend.setup.branch.addBranch');
    }

    public function storeBranch(Request $request)

    {
        $data = new Branch();
        $data->name = $request->name;
        $data->location = $request->location;

        $data->save();

        $notification = array(
            'message' => 'Details Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('branch.view')->with($notification);
    }

    public function editBranch($id)
    {
        $data['editData'] = Branch::find($id);
        return view('backend.setup.branch.editBranch', $data);
    }

    public function updateBranch(Request $request, $id)
    {
        $data = Branch::find($id);
        $data->name = $request->name;
        $data->location = $request->location;

        $data->save();

        $notification = array(
            'message' => 'Details updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('branch.view')->with($notification);
    }

    public function deleteBranch($id)
    {
        $data = Branch::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Details Deleted',
            'alert-type' => 'info'
        );

        return redirect()->route('branch.view')->with($notification);
    }
}
