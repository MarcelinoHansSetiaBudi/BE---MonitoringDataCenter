<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStaff extends Model
{
    use HasFactory;

    protected $table = 'data_staff';

    protected $fillable =[
        'name',
        'address',
        'phone',
        'email'
    ];
}
