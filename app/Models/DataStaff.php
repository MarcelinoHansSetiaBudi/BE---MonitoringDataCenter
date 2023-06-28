<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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

    public function shiftStaff()
    {
        return $this->hasMany(ShiftStaff::class, 'shift_staff_id', 'id');
    }

    public function ReportMaintenance()
    {
        return $this->hasMany(ReportMaintenance::class, 'report_maintenance_id', 'id');
    }

    public function ReportMonitoring()
    {
        return $this->hasMany(ReportMonitoring::class, 'report_monitoring_id', 'id');
    }
}
