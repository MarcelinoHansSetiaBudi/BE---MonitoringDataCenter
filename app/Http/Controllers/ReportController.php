<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::all();
        return response()->json([
            'status' => 'success',
            'data' => $report
        ]);
    }

    public function show($id)
    {
        $report = Report::find($id);
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
            'status' => 'required',
            'maintenance_date' => 'required|date'
        ]);

        $report = Report::create($validatedData);

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
            'status' => 'required',
            'maintenance_date' => 'required|date'
        ]);

        $report = Report::find($id);
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

    // Menghapus data
    public function destroy($id)
    {
        $report = Report::find($id);
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