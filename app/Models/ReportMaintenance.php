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
    
    public function shiftStaff()
    {
        return $this->belongsTo(ShiftStaff::class, 'shift_staff_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function dataStaff()
    {
        return $this->belongsTo(DataStaff::class, 'staff_id', 'id');
    }
}
