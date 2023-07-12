<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuWebAdminModel extends Model
{
    use HasFactory;

    protected $table = 'ht_tbl_adminwebmenu';
    protected $primaryKey = 'IdMenuAdmin';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';
}
