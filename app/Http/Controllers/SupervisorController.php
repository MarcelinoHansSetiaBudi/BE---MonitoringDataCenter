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
        return response()->json([
            'status' => 'success',
            'data' => $supervisor
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

        return response()->json([
            'status' => 'success',
            'data' => $supervisor
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
