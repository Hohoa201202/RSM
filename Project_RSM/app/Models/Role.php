<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'ht_tbl_Role';
    protected $primaryKey = 'IdRole';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['IdGroup', 'IdMenuAdmin', 'Description'];

    // public function groupUser(){
    //     return $this->belongsTo(GroupUser::class);
    // }
}
