<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $table = 'supervisor';

    protected $fillable = [
        'report_id',
        'name',
        'feedback',
        'report_monitoring_id'
    ];
}
