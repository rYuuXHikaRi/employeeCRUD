<?php

namespace App\Http\Controllers\Api;

use App\Models\Employees;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $filterByStatus = $request->input("status");
        $filterByKeyword = $request->input("search");
        $query = Employees::query();

        if ($filterByStatus) {
            $query->where("status", $filterByStatus);
        } else if ($filterByKeyword) {
            $query->where(function($q) use ($filterByKeyword) {
                $q->where('name', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('email', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('position', 'LIKE', "%{$filterByKeyword}%")
                ->orWhere('salary', $filterByKeyword);
            });
        }
            
        $employees = $query->get();

        if ($employees->isEmpty() == false) {
            $employees = $query->paginate(10);
            return response()->json([
                'success' => true,
                'message' => "Data pegawai ditemukan",
                'current_page'  => $employees->currentPage(),
                'total_pages'   => $employees->lastPage(),
                'total_items'   => $employees->total(),
                'data'          => $employees->items(),
                'links'         => [
                    'next_page_url' => $employees->nextPageUrl(),
                    'prev_page_url' => $employees->previousPageUrl()
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data pegawai tidak ditemukan"
            ], 404);
        }
        
    }

    public function show(string $id)
    {   
        try {
            $employee = Employees::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => "Data pegawai ditemukan",
                'data' => $employee
            ], 200);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => "Data pegawai tidak ditemukan"
            ], 404);
         }
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'position' => 'required|string',
            'salary' => 'required|integer|min:2000000|max:50000000',
            'status' => 'required|string|in:active,inactive',
            'hired_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            $employee = Employees::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil ditambahkan',
                'data' => $employee
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data pegawai',
                'details' => $e->getMessage()
            ], 500);
        }

    }

    public function update(Request $request, string $id) {
        try {
            $employee = Employees::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:employees,email' . $id,
                'position' => 'required|string',
                'salary' => 'required|integer|min:2000000|max:50000000',
                'status' => 'required|string|in:active,inactive',
                'hired_at' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'details' => $validator->errors()
                ], 422);
            }

            $employee->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil diupdate',
                'data' => $employee
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => "Data pegawai tidak ditemukan"
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data pegawai',
                'details' => $e->getMessage()
            ], 500);
        }
    }


}
