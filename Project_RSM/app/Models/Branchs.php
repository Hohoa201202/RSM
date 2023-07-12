<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    use HasFactory;

    protected $table = 'dm_tbl_Branchs';
    protected $primaryKey = 'IdBranch';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'int';

    protected $fillable = ['BranchName', 'Address', 'PhoneNumber', 'Email', 'isActive', 'Description'];
}
