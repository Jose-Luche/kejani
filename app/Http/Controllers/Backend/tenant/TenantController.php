<?php

namespace App\Http\Controllers\Backend\tenant;

use App\Models\Unit;
use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Exports\TenantExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class TenantController extends Controller
{
    public function tenDetails($id)
    {
        return Tenant::where('id', $id)->first();
    }

    public function viewTen()
    {
        $data['allData'] = Tenant::all();
        return view('backend.tenant.viewTenant', $data);
    }

    public function addTen()
    {
        $data['branches'] = Branch::all();
        $data['units'] = Unit::all();
        $data['tenants'] = Tenant::all();

        return view('backend.tenant.addTenant', $data);
    }

    public function storeTen(Request $request)
    {
        $tenant = new Tenant();
        $tenant->unit_id = $request->unit_id;
        $tenant->branch_id = $request->branch_id;
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->mobile = $request->mobile;
        $tenant->mobile2 = $request->mobile2;
        $tenant->id_no = $request->id_no;
        $tenant->occupation = $request->occupation;

        if ($request->file('image')) {
            $file = $request->file('image');
            //@unlink(public_path('upload/tenant_images/' . $tenant->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/tenant_images'), $filename);
            $tenant['image'] = $filename;
        }

        $tenant->save();

        $notification = array(
            'message' => 'Tenant added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('tenant.view')->with($notification);
    }

    public function editTen($id)
    {
        $data['editData'] = Tenant::find($id);
        $data['branches'] = Branch::all();
        $data['units'] = Unit::all();

        return view('backend.tenant.editTenant', $data);
    }

    public function updateTen(Request $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->unit_id = $request->unit_id;
        $tenant->branch_id = $request->branch_id;
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->mobile = $request->mobile;
        $tenant->mobile2 = $request->mobile2;
        $tenant->id_no = $request->id_no;
        $tenant->occupation = $request->occupation;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/tenant_images/' . $tenant->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/tenant_images'), $filename);
            $tenant['image'] = $filename;
        }

        $tenant->save();

        $notification = array(
            'message' => 'Details updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('tenant.view')->with($notification);
    }

    public function exportInExcel()
    {
        return Excel::download(new TenantExport, 'tenants.xlsx');
    }

    public function index()
    {
        $chart_options = [
            'chart_title' => 'Tenants',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 100, // show only last 30 days
        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tenants',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 100, // show only last 30 days
        ];

        $chart2 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tenants',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 100, // show only last 30 days
        ];

        $chart3 = new LaravelChart($chart_options);

        return view('backend.setup.unit.charts', compact('chart1', 'chart2', 'chart3'));
    }
}
