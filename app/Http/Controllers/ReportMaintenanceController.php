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
        $list = [];

        foreach ($reportmaintenance as $data) {
            $reportmaintenanceData = [
                'id' => $data->id,
                'shift_staff_id' => $data->shift_staff_id,
                'staff_id' => $data->shiftStaff->staff_id,
                'name_staff' => $data->shiftStaff->dataStaff->name,
                'shift_id' => $data->shiftStaff->shift_id,
                'shift_name' => $data->shiftStaff->shift->shift_name,
                'shift_start' => $data->shiftStaff->shift->shift_start,
                'shift_end' => $data->shiftStaff->shift->shift_end,
                'product_id' => $data->product_id,
                'name_product' => $data->product->name,
                'repair_status' => $data->repair_status,
                'server_status' => $data->servet_status,
                'maintenance_date' => $data->maintenance_date

            ];

            $list[] = $reportmaintenanceData;
    }
    
        return response()->json([
            'status' => 'success',
            'data' => $list
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

        $reportmaintenanceData = [
            'id' => $reportmaintenance->id,
            'shift_staff_id' => $reportmaintenance->shift_staff_id,
            'staff_id' => $reportmaintenance->shiftStaff->staff_id,
            'name_staff' => $reportmaintenance->shiftStaff->dataStaff->name,
            'shift_id' => $reportmaintenance->shiftStaff->shift_id,
            'shift_name' => $reportmaintenance->shiftStaff->shift->shift_name,
            'shift_start' => $reportmaintenance->shiftStaff->shift->shift_start,
            'shift_end' => $reportmaintenance->shiftStaff->shift->shift_end,
            'product_id' => $reportmaintenance->product_id,
            'name_product' => $reportmaintenance->product->name,
            'repair_status' => $reportmaintenance->repair_status,
            'server_status' => $reportmaintenance->servet_status,
            'maintenance_date' => $reportmaintenance->maintenance_date

        ];

        $list[] = $reportmaintenanceData;

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