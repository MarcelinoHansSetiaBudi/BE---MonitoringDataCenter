<?php

namespace App\Http\Controllers;

use App\Models\ReportMaintenance;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportmaintenance = ReportMaintenance::all();
        return response()->json([
            'status' => 'success',
            'data' => $reportmaintenance
        ]);
    }

    public function show($id)
    {
        $reportmaintenance = ReportMaintenance::find($id);
        if (!$reportmaintenance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $reportmaintenance
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shift_staff_id' => 'required|integer',
            'product_id' => 'required|integer',
            'repair_status' => 'required',
            'server_status' => 'required',
            'maintenance_date' => 'required|date'
        ]);

        $reportmaintenance = ReportMaintenance::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $reportmaintenance
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shift_staff_id' => 'sometimes|required|integer',
            'product_id' => 'sometimes|required|integer',
            'repair_status' => 'sometimes|required',
            'server_status' => 'sometimes|required',
            'maintenance_date' => 'required|date'
        ]);

        $reportmaintenance = ReportMaintenance::find($id);
        if (!$reportmaintenance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $reportmaintenance->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $reportmaintenance
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $reportmaintenance = ReportMaintenance::find($id);
        if (!$reportmaintenance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $reportmaintenance->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }

    public function count()
    {
        $total = ReportMaintenance::count();

        return response()->json([
            'status' => 'success',
            'total report maintenance' => $total
        ]);
    }
}