<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMaintenance extends Model
{
    use HasFactory;
    protected $table = 'report_maintenance';

    protected $fillable = [
        'shift_staff_id',
        'product_id',
        'repair_status',
        'server_status',
        'maintenance_date'
    ];
}
