<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisor = Supervisor::all();
        $list = [];
        foreach ($supervisor as $data) {
                $supervisorData = [
                    'id' => $data->id,
                    'name_supervisor' => $data->name,
                    'report_monitoring_id' => $data->report_monitoring_id,
                    'product_id' => $data->reportMonitoring->product_id,
                    'name_product' => $data->reportMonitoring->product->name,
                    'crash_status' => $data->reportMonitoring->crash_status,
                    'feedback' => $data->feedback
                ];
    
                $list[] = $supervisorData;
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }

    public function show($id)
    {
        $supervisor = Supervisor::find($id);
        if (!$supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $supervisorData = [
            'id' => $supervisor->id,
            'name_supervisor' => $supervisor->name,
            'report_monitoring_id' => $supervisor->report_monitoring_id,
            'product_id' => $supervisor->reportMonitoring->product_id,
            'name_product' => $supervisor->reportMonitoring->product->name,
            'crash_status' => $supervisor->reportMonitoring->crash_status,
            'feedback' => $supervisor->feedback
        ];

        $list[] = $supervisorData;

        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'report_monitoring_id' => 'required|integer',
            'feedback' => 'required|string'
        ]);

        $supervisor = Supervisor::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $supervisor
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required',
            'report_monitoring_id' => 'sometimes|required|integer',
            'feedback' => 'sometimes|required|string'
        ]);

        $supervisor = Supervisor::find($id);
        if (!$supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $supervisor->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $supervisor
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);
        if (!$supervisor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $supervisor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}
