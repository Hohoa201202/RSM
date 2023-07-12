<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $table = 'tbl_combo';
    protected $primaryKey = 'IdCombo';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['ComboName', 'CostPrice', 'Price', 'Avatar', 'isActive', 'Description' ];
}
