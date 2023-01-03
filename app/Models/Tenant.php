<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function apartment()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    //A Tenant has many bills
    public function bills()
    {
        return $this->hasMany(Projection::class, 'tenant_id', 'id')->orderBy('date', 'desc');
    }

    //A Tenant has many receipts
    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'tenantId', 'id');
    }

    public static function getTenants()
    {
        $data = DB::table('tenants')->select('name', 'mobile', 'email', 'branch_id', 'unit_id')->get()->toArray();
        return $data;
    }
}
