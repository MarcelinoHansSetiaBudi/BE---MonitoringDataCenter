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
        $list = [];
    
        foreach ($shiftStaff as $data) {
            if ($data->dataStaff) {
                $name = $data->dataStaff->name;
    
                $shiftData = [
                    'id' => $data->id,
                    'staff_id' => $data->staff_id,
                    'name' => $name,
                    'shift_id' => $data->shift_id,
                    'shift_start' => $data->shift->shift_start,
                    'shift_end' => $data->shift->shift_end
                ];
    
                $list[] = $shiftData;
            }
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $list
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
        $name = $shiftStaff->dataStaff->name;

        $shiftStaffData = [
            'id' => $shiftStaff->id,
            'staff_id' => $shiftStaff->staff_id,
            'name' => $name,
            'shift_id' => $shiftStaff->shift_id,
            'shift_start' => $shiftStaff->shift->shift_start,
            'shift_end' => $shiftStaff->shift->shift_end
        ];

        $data[] = $shiftStaffData;

        return response()->json([
            'status' => 'success',
            'data' => $data
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
