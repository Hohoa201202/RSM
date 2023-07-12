<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'dm_tbl_orderstatus';
    protected $primaryKey = 'IdStatus';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['StatusName', 'isActive', 'Description'];
}
