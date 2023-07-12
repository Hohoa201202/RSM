<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInfo extends Model
{
    use HasFactory;

    protected $table = 'tbl_res_info';
    protected $primaryKey = 'Id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['ResName', 'Hotline1', 'Hotline2', 'Email', 'Logo', 'OpeningDay', 'OpenTime', 'CloseTime', 'ShortDescription' , 'LongDescription'];
}
