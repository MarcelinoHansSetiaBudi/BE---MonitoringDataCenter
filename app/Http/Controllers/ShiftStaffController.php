<?php

namespace App\Http\Controllers;

use App\Models\ShiftStaff;
use Illuminate\Http\Request;

class ShiftStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shiftStaff = ShiftStaff::all();
        return response()->json([
            'status' => 'success',
            'data' => $shiftStaff
        ]);
    }

    public function show($id)
    {
        $shiftStaff = ShiftStaff::find($id);
        if (!$shiftStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $shiftStaff
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|integer',
            'shift_id' => 'required|integer',
        ]);

        $shiftStaff = ShiftStaff::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $shiftStaff
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff_id' => 'sometimes|required|integer',
            'shift_id' => 'sometimes|required|integer',
        ]);

        $shiftStaff = ShiftStaff::find($id);
        if (!$shiftStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $shiftStaff->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $shiftStaff
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $shiftStaff = ShiftStaff::find($id);
        if (!$shiftStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $shiftStaff->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}
