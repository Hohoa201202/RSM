<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'tbl_booking';
    protected $primaryKey = 'IdBooking';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdCustomer', 'PrePayment', 'IdBranch', 'Discount', 'IdTable', 'BookingDate', 'TimeSlot', 'NumberGuests', 'IdStatus', 'NumberGuests', 'isActive', 'Note'];
}
