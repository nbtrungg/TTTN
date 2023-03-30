<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Định dạng toàn bộ hàng đầu tiên với font chữ được in dậm
             1    => ['font' => ['bold' => true]],

            // Định dạng giá trị tại ô B2 có font là in nghiêng
            // 'B2' => ['font' => ['italic' => true]],

            // Định dạng font-size cho toàn bộ cột C
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    public function headings(): array {
        return [
          
          'Tên khách hàng',
          'Địa chỉ',
          'SĐT',
          'Email',
          'Trạng thái',
        ];
      }
    
    public function map($customer): array
    {
      // $customers = Customer::with('customermail')->get();
      $emails = $customer->customermail->pluck('mail')->implode('#');
      return [
        //   $user->id,
          $customer->customer_name,
          $customer->address,
          (string)$customer->phone,
          $emails,
          (string)$customer->status,
      ];
    }
}
