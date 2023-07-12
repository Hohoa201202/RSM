<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'ht_tbl_slideweb';
    protected $primaryKey = 'IdSlide';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdSlide', 'Title', 'SubTitle', 'ImageName', 'Position', 'Order', 'isActive', 'Description' ];
}
