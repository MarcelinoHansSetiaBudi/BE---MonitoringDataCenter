<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';

    protected $fillable = [
        'shift_name',
        'shift_start',
        'shift_end'
    ];

    public function shiftStaff()
    {
        return $this->hasMany(ShiftStaff::class);
    }

    public function ReportMaintenance()
    {
        return $this->hasMany(ReportMaintenance::class,'report_maintenance_id', 'id');
    }

    public function ReportMonitoring()
    {
        return $this->hasMany(ReportMonitoring::class, 'report_monitoring_id', 'id');
    }
}
