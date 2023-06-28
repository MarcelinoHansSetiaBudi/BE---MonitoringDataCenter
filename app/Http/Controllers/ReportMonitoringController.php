<?php

namespace App\Http\Controllers;

use App\Models\ReportMonitoring;
use Illuminate\Http\Request;

class ReportMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportMonitoring = ReportMonitoring::all();
        $list = [];

        foreach ($reportMonitoring as $data) {
            $reportmonitoringData = [
                'id' => $data->id,
                'shift_staff_id' => $data->shift_staff_id,
                'staff_id' => $data->shiftStaff->staff_id,
                'name_staff' => $data->shiftStaff->dataStaff->name,
                'shift_id' => $data->shiftStaff->shift_id,
                'shift_start' => $data->shiftStaff->shift->shift_start,
                'shift_end' => $data->shiftStaff->shift->shift_end,
                'product_id' => $data->product_id,
                'name_product' => $data->product->name,
                'server_status' => $data->server_status,
                'crash_status' => $data->crash_status,
                'maintenance_date' => $data->monitoring_date

            ];

            $list[] = $reportmonitoringData;
    }
    
        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }

    public function show($id)
    {
        $reportmonitoring = ReportMonitoring::find($id);
        if (!$reportmonitoring) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $reportmonitoringData = [
            'id' => $reportmonitoring->id,
            'shift_staff_id' => $reportmonitoring->shift_staff_id,
            'staff_id' => $reportmonitoring->shiftStaff->staff_id,
            'name_staff' => $reportmonitoring->shiftStaff->dataStaff->name,
            'shift_id' => $reportmonitoring->shiftStaff->shift_id,
            'shift_start' => $reportmonitoring->shiftStaff->shift->shift_start,
            'shift_end' => $reportmonitoring->shiftStaff->shift->shift_end,
            'product_id' => $reportmonitoring->product_id,
            'name_product' => $reportmonitoring->product->name,
            'server_status' => $reportmonitoring->server_status,
            'crash_status' => $reportmonitoring->crash_status,
            'monitoring_date' => $reportmonitoring->monitoring_date

        ];

        $list[] = $reportmonitoringData;

        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shift_staff_id' => 'required|integer',
            'product_id' => 'required|integer',
            'server_status' => 'required',
            'crash_status' => 'required',
            'monitoring_date' => 'required|date'
        ]);

        $report = ReportMonitoring::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $report
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shift_staff_id' => 'sometimes|required|integer',
            'product_id' => 'sometimes|required|integer',
            'server_status' => 'sometimes|required',
            'crash_status' => 'sometimes|required',
            'monitoring_date' => 'required|date'
        ]);

        $report = ReportMonitoring::find($id);
        if (!$report) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $report->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $report
        ]);
    }

    public function count() 
    {
        $totalreport = ReportMonitoring::count();
        return response()->json([
            'status' => 'success',
            'total report' => $totalreport
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $report = ReportMonitoring::find($id);
        if (!$report) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}