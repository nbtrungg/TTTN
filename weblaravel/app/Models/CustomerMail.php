<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='customer_mail';
    protected $fillable=[
        'customer_id',
        'mail',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
