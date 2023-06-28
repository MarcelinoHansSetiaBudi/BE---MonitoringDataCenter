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

    public function supervisor()
    {
        return $this->hasMany(Supervisor::class, 'supervisor_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
