<?php

namespace App\Http\Controllers\Backend\tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantProfileController extends Controller
{
    public function viewProf($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        $bills = [];
        if ($tenant->bills != null) {
            $bills = $tenant->bills;
        }

        $receipts = [];
        if ($tenant->receipts != null) {
            $receipts = $tenant->receipts;
        }

        //dd($tenant->bills);

        return view('backend.tenant.viewProfile', compact('tenant', 'bills', 'receipts'));
    }
}
