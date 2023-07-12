<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;

    protected $table = 'tbl_pricelist';
    protected $primaryKey = 'IdPrice';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdItems', 'PriceName', 'SalePrice', 'CostPrice', 'isActive', 'Description' ];
}
