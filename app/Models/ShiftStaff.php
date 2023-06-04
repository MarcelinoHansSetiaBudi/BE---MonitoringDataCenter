<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftStaff extends Model
{
    use HasFactory;

    protected $table = 'shift_staff';

    protected $fillable = [
        'staff_id',
        'shift_id'
    ];
}
