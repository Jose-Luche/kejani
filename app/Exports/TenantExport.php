<?php

namespace App\Exports;

use App\Models\Tenant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TenantExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Name',
            'Mobile',
            'Address',
            'Apartment',
            'House No.'

        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return Tenant::all();
        return collect(Tenant::getTenants());
    }
}
