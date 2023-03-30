<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, ShouldAutoSize, WithStyles, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employe::all();
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
          
          'Họ tên nhân viên',
          'Ảnh đại diện',
          'SĐT',
          'Email',
          'Trạng thái',
          'Địa Chỉ',
          'Password',
          'Vai trò'
        ];
      }
    
    public function map($user): array
    {
      return [
        //   $user->id,
          $user->name,
          $user->avatar,
          (string)$user->phone,
          $user->email,
          (string)$user->status,
          $user->address,
          $user->password,
          (string)$user->roll,
      ];
    }
    
}
