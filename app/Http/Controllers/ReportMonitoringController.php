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
        $report = ReportMonitoring::all();
        return response()->json([
            'status' => 'success',
            'data' => $report
        ]);
    }

    public function show($id)
    {
        $report = ReportMonitoring::find($id);
        if (!$report) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $report
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