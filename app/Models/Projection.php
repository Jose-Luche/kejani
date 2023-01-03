<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Backend\projections\ProjectionBalanceController;

class Projection extends Model
{
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    /** A projection has receipt allocations */
    public function amountAllocated()
    {
        return $this->hasMany(allocReceipt::class, 'projId', 'id');
    }

    public function projectionBalance($id)
    {
        return (new ProjectionBalanceController)->projectionBalance($id);
    }

    public function totalAmountPaid($id)
    {
        return (new ProjectionBalanceController)->projAmountPaid($id);
    }
}
