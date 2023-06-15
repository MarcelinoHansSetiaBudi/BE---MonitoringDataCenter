<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMonitoring extends Model
{
    use HasFactory;

    protected $table = 'report_monitoring';

    protected $fillable = [
        'shift_staff_id',
        'product_id',
        'server_status',
        'crash_status',
        'monitoring_date'
    ];
}
