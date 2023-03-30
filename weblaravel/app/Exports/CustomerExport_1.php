<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\CustomerMail;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport_1 implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }
}
