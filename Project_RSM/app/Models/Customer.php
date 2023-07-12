<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'tbl_Customer';
    protected $primaryKey = 'IdCustomer';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'string';

    protected $fillable = [
        'UserName',
        'IdCustomer',
        'UserName',
        'PassWord',
        'LastName',
        'FirstName',
        'Gender',
        'Avatar',
        'PhoneNumber',
        'Email',
        'Province',
        'District',
        'Ward',
        'Address',
        'LastLogin',
        'isActive',
        'Description',
        'created_at',
        'updated_at'
    ];
}
