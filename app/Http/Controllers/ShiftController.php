<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shift = Shift::all();
        return response()->json([
            'status' => 'success',
            'data' => $shift
        ]);
    }

    public function show($id)
    {
        $shift = Shift::find($id);
        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $shift
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shift_name' => 'required|string|unique:shift,shift_name',
            'shift_start' => 'required',
            'shift_end' => 'required',
        ]);

        $shift = Shift::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $shift
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shift_name' => 'sometimes|required|string|unique:shift,shift_name',
            'shift_start' => 'sometimes|required',
            'shift_end' => 'sometimes|required',
        ]);

        $shift = Shift::find($id);
        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $shift->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $shift
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $shift = Shift::find($id);
        if (!$shift) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $shift->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}