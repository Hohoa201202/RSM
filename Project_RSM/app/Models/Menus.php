<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'tbl_menus';
    protected $primaryKey = 'IdMenu';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdMenu', 'MenuName', 'OrderMenu', 'Avatar', 'isActive', 'Description' ];
}
