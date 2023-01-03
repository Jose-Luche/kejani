<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenantId', 'id');
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'ledgerId', 'id');
    }

    public function receiptAllocations()
    {
        return $this->hasMany(allocReceipt::class, 'recId', 'id');
    }
}
