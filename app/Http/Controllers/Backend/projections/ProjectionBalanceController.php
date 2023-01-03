<?php

namespace App\Http\Controllers\Backend\projections;

use App\Http\Controllers\Controller;
use App\Models\Projection;
use Illuminate\Http\Request;

class ProjectionBalanceController extends Controller
{
    public function billDetails($id)
    {
        return Projection::where('id', $id)->first();
    }

    public function projectionBalance($id)
    {
        //find the particular object with the projection id
        $billAmount = $this->billDetails($id)->amount ?? 0;
        $totalAmountPaid = $this->projAmountPaid($id);

        $balance = $billAmount - $totalAmountPaid;

        return $balance;
    }

    public function projAmountPaid($id)
    {
        $totalAmountPaid = 0;
        foreach ($this->billDetails($id)->amountAllocated as $row) {
            $totalAmountPaid += $row->amount;
        }

        return $totalAmountPaid;
    }
}
