<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;

    protected $table = 'tbl_Tables';
    protected $primaryKey = 'IdTable';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['TableName', 'IdArea', 'IdType', 'IdStatus', 'isActive', 'Description'];
}
