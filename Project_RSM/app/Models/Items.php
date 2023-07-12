<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'tbl_items';
    protected $primaryKey = 'IdItems';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['ItemsName', 'Unit', 'IdCategory', 'Avatar', 'isActive', 'Description'];
}
