<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function UserView()
    {
        $data['allData'] = User::all();
        return view('backend.user.viewUser', $data);
    }

    public function UserAdd()
    {
        return view('backend.user.addUser');
    }

    public function UserStore(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $code = rand(0000, 9999);
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;

        $data->save();

        $notification = array(
            'message' => 'User Created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function userEdit($id)
    {
        $editData = User::find($id);
        return view('backend.user.editUser', compact('editData'));
    }

    public function userUpdate(Request $request, $id)
    {

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;

        $data->save();

        $notification = array(
            'message' => 'User Updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function userDelete($id)
    {
        $data = User::find($id);
        $data->delete();

        $notification = array(
            'message' => 'User Deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function exportInExcel()
    {
        return Excel::download(new UsersExport, 'userslist.xlsx');
    }
}
