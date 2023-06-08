<?php

namespace App\Http\Controllers;

use App\Models\DataStaff;
use Illuminate\Http\Request;

class DataStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataStaff = DataStaff::all();
        return response()->json([
            'status' => 'success',
            'data' => $dataStaff
        ]);
    }

    public function show($id)
    {
        $dataStaff = DataStaff::find($id);
        if (!$dataStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $dataStaff
        ]);
    }

    // Menambahkan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:data_staff,email'
        ]);

        $dataStaff = DataStaff::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $dataStaff
        ], 201);
    }
     

    // Mengubah data
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required',
            'address' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'email' => 'sometimes|required'
        ]);

        $dataStaff = DataStaff::find($id);
        if (!$dataStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $dataStaff->update($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $dataStaff
        ]);
    }

    // Menghapus data
    public function destroy($id)
    {
        $dataStaff = DataStaff::find($id);
        if (!$dataStaff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }

        $dataStaff->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}