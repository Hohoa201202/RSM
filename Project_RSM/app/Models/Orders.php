<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'tbl_Orders';
    protected $primaryKey = 'IdOrder';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = [
        'IdCustomer', 'IdBooking', 'IdTable', 'Discount', 'IdUser',
        'OrderDate', 'TimeIn', 'TimeOut', 'TotalAmount', 'TotalCost',
        'PaymentMethod', 'PaymentTime', 'Status', 'Notes'
    ];
}
