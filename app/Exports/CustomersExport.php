<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Id',
            'contract_id',
            'contact_persons_id',
            'companyname',
            'name',
            'mail',
            'BKR-check',
            'Order-status',

        ];
    }

    /**
    * @return Collection
    */
    public function collection()
    {
        return Customer::all();
    }
}
