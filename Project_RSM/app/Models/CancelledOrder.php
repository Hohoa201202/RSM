<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledOrder extends Model
{
    use HasFactory;

    protected $table = 'tbl_cancelledorder';
    protected $primaryKey = 'Id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdOrder', 'CancellationReason', 'CancellationDate', 'CancelledBy'];
}
