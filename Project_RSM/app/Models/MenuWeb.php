<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuWeb extends Model
{
    use HasFactory;

    protected $table = 'ht_tbl_menuweb';
    protected $primaryKey = 'IdMenu';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdMenu', 'MenuName', 'ControllerName', 'ActionName', 'Lever', 'Position', 'Order', 'ParentId', 'isActive', 'UserCreated', 'UserEdit', 'Icon', 'Description'];
}
