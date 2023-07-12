<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'ht_tbl_Group';
    protected $primaryKey = 'IdGroup';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['GroupName', 'Description'];

    // public function role(){
    //     return $this->hasMany(Role::class);
    // }
}
